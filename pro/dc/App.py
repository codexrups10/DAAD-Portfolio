"""
Tiffin Tales — Full Stack Backend
Flask + SQLite + JWT Authentication
"""

import sqlite3
import os
import hashlib
import hmac
import base64
import json
import time
from datetime import datetime, timedelta
from flask import Flask, request, jsonify, send_from_directory, g
from flask_cors import CORS
from functools import wraps

app = Flask(__name__, static_folder='public', static_url_path='')
CORS(app, origins='*')

SECRET_KEY = "tiffin_tales_secret_2026_jwt"
DB_PATH = os.path.join(os.path.dirname(__file__), 'tiffin_tales.db')

# ─────────────────────────────────────────
# DATABASE SETUP
# ─────────────────────────────────────────
def get_db():
    if 'db' not in g:
        g.db = sqlite3.connect(DB_PATH)
        g.db.row_factory = sqlite3.Row
        g.db.execute("PRAGMA foreign_keys = ON")
    return g.db

@app.teardown_appcontext
def close_db(e=None):
    db = g.pop('db', None)
    if db: db.close()

def init_db():
    db = sqlite3.connect(DB_PATH)
    db.row_factory = sqlite3.Row
    c = db.cursor()

    c.executescript("""
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        phone TEXT,
        role TEXT DEFAULT 'customer',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS categories (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT UNIQUE NOT NULL,
        slug TEXT UNIQUE NOT NULL,
        description TEXT,
        icon TEXT,
        sort_order INTEGER DEFAULT 0
    );

    CREATE TABLE IF NOT EXISTS menu_items (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        category_id INTEGER REFERENCES categories(id),
        name TEXT NOT NULL,
        slug TEXT UNIQUE NOT NULL,
        description TEXT,
        price REAL NOT NULL,
        image_url TEXT,
        tag TEXT,
        badge TEXT,
        is_spicy INTEGER DEFAULT 0,
        is_vegan INTEGER DEFAULT 1,
        is_available INTEGER DEFAULT 1,
        is_featured INTEGER DEFAULT 0,
        rating REAL DEFAULT 4.5,
        total_orders INTEGER DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS reservations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER REFERENCES users(id),
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        phone TEXT NOT NULL,
        date TEXT NOT NULL,
        time TEXT NOT NULL,
        guests INTEGER NOT NULL,
        occasion TEXT,
        special_requests TEXT,
        status TEXT DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS orders (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER REFERENCES users(id),
        guest_name TEXT,
        guest_email TEXT,
        guest_phone TEXT,
        items_json TEXT NOT NULL,
        subtotal REAL NOT NULL,
        tax REAL NOT NULL,
        total REAL NOT NULL,
        order_type TEXT DEFAULT 'dine-in',
        status TEXT DEFAULT 'pending',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS reviews (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER REFERENCES users(id),
        menu_item_id INTEGER REFERENCES menu_items(id),
        name TEXT NOT NULL,
        rating INTEGER NOT NULL CHECK(rating BETWEEN 1 AND 5),
        comment TEXT,
        is_approved INTEGER DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS contact_messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        subject TEXT,
        message TEXT NOT NULL,
        is_read INTEGER DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS newsletter_subscribers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    """)

    # Seed categories
    categories = [
        (1, 'Dosas', 'dosas', 'Crispy South Indian crepes', '🫓', 1),
        (2, 'Idli & Vada', 'idli-vada', 'Steamed cakes & fried fritters', '🍚', 2),
        (3, 'Rice Dishes', 'rice', 'Aromatic rice preparations', '🍛', 3),
        (4, 'Curries & Gravies', 'curries', 'Slow-cooked regional gravies', '🍲', 4),
        (5, 'Snacks & Tiffin', 'snacks', 'Light bites & breakfast plates', '🥘', 5),
        (6, 'Sweets & Desserts', 'sweets', 'Traditional South Indian sweets', '🍮', 6),
        (7, 'Beverages', 'beverages', 'Teas, coffees & cooling drinks', '☕', 7),
    ]
    c.executemany("INSERT OR IGNORE INTO categories VALUES (?,?,?,?,?,?)", categories)

    # Seed menu items
    items = [
        # Dosas (cat 1)
        (1,1,'Masala Dosa','masala-dosa','Golden crispy crepe filled with spiced potato-onion masala, served with coconut chutney and sambar.',120,'https://images.unsplash.com/photo-1668236543090-82eba5ee5976?w=500&q=80','Karnataka Classic','Popular',0,1,1,1,4.8,3420),
        (2,1,'Paper Roast Dosa','paper-roast-dosa','Wafer-thin, melt-on-your-tongue dosa roasted to perfection in pure ghee.',130,'https://images.unsplash.com/photo-1630383249896-424e482df921?w=500&q=80','Crispy','Signature',0,0,1,1,4.7,2100),
        (3,1,'Mysore Masala Dosa','mysore-masala-dosa','Crispy dosa smeared with fiery red chutney, filled with spiced potato masala — the Mysore way.',140,'https://images.unsplash.com/photo-1606491056717-b2e43e9a4e15?w=500&q=80','Karnataka','Spicy',1,1,1,0,4.6,1890),
        (4,1,'Pesarattu','pesarattu','Andhra-style green moong dal crepe, served with ginger chutney and upma.',115,'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=500&q=80','Andhra Special','Healthy',0,1,1,0,4.5,980),
        (5,1,'Rava Onion Dosa','rava-onion-dosa','Lacy porous semolina crepe with caramelised onion and curry leaves.',125,'https://images.unsplash.com/photo-1574484284002-952d92456975?w=500&q=80','Semolina','Popular',0,1,1,1,4.7,2300),
        (6,1,'Neer Dosa','neer-dosa','Feather-light silky rice crepe from coastal Karnataka, best with coconut milk curry.',110,'https://images.unsplash.com/photo-1606491048802-8342506d6471?w=500&q=80','Karnataka Coast','Light',0,1,1,0,4.4,760),
        (7,1,'Set Dosa','set-dosa','Three soft spongy dosas served together — thicker and more filling than regular dosas.',105,'https://images.unsplash.com/photo-1630408284816-f6e2029f6d4d?w=500&q=80','Karnataka','Classic',0,1,1,0,4.5,1200),
        # Idli & Vada (cat 2)
        (8,2,'Plain Idli','plain-idli','Soft airy steamed rice cakes with coconut chutney and fragrant sambar.',80,'https://images.unsplash.com/photo-1630408284816-f6e2029f6d4d?w=500&q=80','Classic','Popular',0,1,1,1,4.6,4100),
        (9,2,'Ghee Podi Idli','ghee-podi-idli','Soft idlis tossed in hand-ground gunpowder spice and golden clarified butter.',100,'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=500&q=80','Indulgent','Signature',0,0,1,1,4.8,3200),
        (10,2,'Medu Vada','medu-vada','Golden fried urad dal fritters, perfectly crunchy outside and fluffy inside.',90,'https://images.unsplash.com/photo-1606491048802-8342506d6471?w=500&q=80','Crispy','Popular',0,1,1,1,4.7,2900),
        (11,2,'Sambar Vada','sambar-vada','Medu vadas dunked in piping hot sambar, soaking up the tangy tamarind broth.',100,'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=500&q=80','Comfort','Classic',0,1,1,0,4.6,1800),
        (12,2,'Kanchipuram Idli','kanchipuram-idli','Temple-style idli infused with pepper, ginger, cashews and ghee tempering.',110,'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=500&q=80','Temple Style','Heritage',0,0,1,0,4.5,890),
        (13,2,'Idli Fries','idli-fries','Leftover idli cut and pan-fried with spices — the ultimate South Indian street snack.',95,'https://images.unsplash.com/photo-1574484284002-952d92456975?w=500&q=80','Fusion','Trending',0,1,1,1,4.4,1400),
        # Rice Dishes (cat 3)
        (14,3,'Bisi Bele Bath','bisi-bele-bath','Karnataka beloved one-pot rice-lentil-vegetable porridge with ghee and cashews.',160,'https://images.unsplash.com/photo-1545247181-516773cae754?w=500&q=80','Karnataka','Popular',0,0,1,1,4.8,2600),
        (15,3,'Thayir Sadam','thayir-sadam','Cooling curd rice tempered with mustard seeds, curry leaves and pomegranate.',130,'https://images.unsplash.com/photo-1518169697609-fc2a68766ee7?w=500&q=80','Tamil','Cooling',0,1,1,0,4.5,1300),
        (16,3,'Ven Pongal','ven-pongal','Creamy rice-moong dal porridge with black pepper, cumin and cashews in brown butter.',110,'https://images.unsplash.com/photo-1512058454905-6b841e7ad132?w=500&q=80','Festival','Popular',0,1,1,1,4.7,2100),
        (17,3,'Elumichai Sadam','elumichai-sadam','Zesty lemon rice with turmeric and peanuts, tempered with mustard and dried red chillies.',120,'https://images.unsplash.com/photo-1631452180539-96aca7d48617?w=500&q=80','Tangy','Classic',0,1,1,0,4.4,980),
        (18,3,'Thengai Sadam','thengai-sadam','Fluffy rice tossed with fresh grated coconut, curry leaves and cashews.',130,'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=500&q=80','Coastal','Festive',0,1,1,0,4.5,870),
        (19,3,'Gongura Pulihora','gongura-pulihora','Andhra tamarind rice with tangy sorrel leaves — punchy and addictive flavour.',145,'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=500&q=80','Andhra','Bold',1,1,1,0,4.6,1100),
        # Curries (cat 4)
        (20,4,'Veechu Sambar','veechu-sambar','Light aromatic sambar with pearl onions, tomato and a special spice blend.',80,'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=500&q=80','Tamil Nadu','Essential',0,1,1,1,4.7,5600),
        (21,4,'Chettinad Vegetable Curry','chettinad-veg-curry','Bold aromatic Chettinad masala with kalpasi and star anise.',180,'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=500&q=80','Chettinad','Fiery',1,1,1,1,4.8,1900),
        (22,4,'Avial','avial','Kerala crown jewel — mixed vegetables in thick coconut-curd gravy.',160,'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=500&q=80','Kerala','Heritage',0,1,1,1,4.6,1400),
        (23,4,'Pepper Rasam','pepper-rasam','Thin soothing tomato-tamarind broth with black pepper and cumin.',70,'https://images.unsplash.com/photo-1512058454905-6b841e7ad132?w=500&q=80','Medicinal','Soul Food',0,1,1,0,4.5,2300),
        (24,4,'Kootu Curry','kootu-curry','Kerala lentil and yam curry thickened with roasted coconut paste.',155,'https://images.unsplash.com/photo-1631452180539-96aca7d48617?w=500&q=80','Kerala','Rustic',0,1,1,0,4.5,890),
        # Snacks (cat 5)
        (25,5,'Kuzhi Paniyaram','kuzhi-paniyaram','Bite-sized fermented rice dumplings cooked in cast iron moulds.',95,'https://images.unsplash.com/photo-1574484284002-952d92456975?w=500&q=80','Street Food','Popular',0,1,1,1,4.7,2400),
        (26,5,'Rava Upma','rava-upma','Savoury semolina porridge with ghee, mustard, curry leaves and cashews.',85,'https://images.unsplash.com/photo-1606491048802-8342506d6471?w=500&q=80','Breakfast','Classic',0,1,1,0,4.3,1600),
        (27,5,'Appam & Stew','appam-stew','Lacy rice-coconut hoppers with gentle coconut milk-vegetable stew.',150,'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&q=80','Kerala','Signature',0,1,1,1,4.9,2100),
        (28,5,'Puttu & Kadala','puttu-kadala','Steamed rice-coconut cylinders with robust black chickpea curry.',140,'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=500&q=80','Kerala Breakfast','Heritage',0,1,1,1,4.7,1700),
        (29,5,'Adai Avial','adai-avial','Thick multi-lentil pancake served alongside creamy avial.',145,'https://images.unsplash.com/photo-1630383249896-424e482df921?w=500&q=80','Protein Rich','Wholesome',0,1,1,0,4.6,1100),
        (30,5,'Malabar Parotta','malabar-parotta','Flaky layered flatbread from Kerala — soft, buttery and deeply satisfying.',110,'https://images.unsplash.com/photo-1630408284816-f6e2029f6d4d?w=500&q=80','Kerala','Bestseller',0,0,1,1,4.8,3100),
        # Sweets (cat 6)
        (31,6,'Kesari Halwa','kesari-halwa','Semolina pudding with saffron, golden raisins and cashews in fragrant ghee.',90,'https://images.unsplash.com/photo-1571104508999-893933ded431?w=500&q=80','Tamil Classic','Popular',0,0,1,1,4.7,2800),
        (32,6,'Paal Payasam','paal-payasam','Slow-reduced milk pudding with rice, cardamom and rose water.',110,'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&q=80','Temple Offering','Festive',0,0,1,1,4.8,2100),
        (33,6,'Mysore Pak','mysore-pak','Legendary palace sweet — crumbly gram flour fudge saturated in ghee.',80,'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&q=80','Mysore Royal','Heritage',0,0,1,0,4.6,1600),
        (34,6,'Sakkarai Pongal','sakkarai-pongal','Sweet rice-lentil porridge with jaggery, cardamom and ghee-fried cashews.',100,'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=500&q=80','Festival','Traditional',0,0,1,0,4.5,950),
        (35,6,'Elaneer Payasam','elaneer-payasam','Tender coconut pudding blended with condensed milk — light, chilled, divine.',120,'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&q=80','Kerala','Refreshing',0,0,1,0,4.7,1200),
        # Beverages (cat 7)
        (36,7,'Degree Filter Coffee','degree-filter-coffee','South India iconic chicory-coffee decoction poured in traditional dabarah-tumbler style.',60,'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=500&q=80','Must Try','Iconic',0,0,1,1,4.9,7800),
        (37,7,'Spiced Neer Mor','spiced-neer-mor','Thin tempered buttermilk with ginger, green chilli and curry leaves.',50,'https://images.unsplash.com/photo-1541658016709-82835c32e5e6?w=500&q=80','Cooling','Digestive',0,1,1,1,4.5,3400),
        (38,7,'Panakam','panakam','Traditional jaggery-lemon-pepper festival drink — sweet, tangy and cooling.',55,'https://images.unsplash.com/photo-1568702846914-96b305d2aaeb?w=500&q=80','Festive','Heritage',0,1,1,0,4.4,890),
        (39,7,'Rose Milk','rose-milk','Chilled milk with hand-crafted rose syrup — Chennai street nostalgia in a glass.',65,'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=500&q=80','Chennai Classic','Nostalgic',0,1,1,1,4.6,2600),
        (40,7,'Jigarthanda','jigarthanda','Madurai magical iced drink with sarsaparilla syrup, milk ice cream and almond gum.',90,'https://images.unsplash.com/photo-1541658016709-82835c32e5e6?w=500&q=80','Madurai Special','Signature',0,0,1,1,4.8,3100),
    ]
    c.executemany("""
        INSERT OR IGNORE INTO menu_items 
        (id,category_id,name,slug,description,price,image_url,tag,badge,is_spicy,is_vegan,is_available,is_featured,rating,total_orders)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    """, items)

    # Seed reviews
    reviews = [
        (1, None, 1, 'Anjali Krishnamurthy', 5, 'The Chettinad thali was an absolute revelation — layers of spice so beautifully balanced. Best South Indian food outside Chennai.', 1),
        (2, None, None, 'Radhakrishnan Pillai', 5, 'The Kerala Sadya genuinely transported me back to my grandmother\'s home in Thrissur. The avial and olan were perfect.', 1),
        (3, None, 36, 'Subramanya Rao', 5, 'The filter coffee here is genuinely the best I\'ve had outside Chennai. Proper dabarah-tumbler pour and everything.', 1),
        (4, None, 27, 'Priya Nambiar', 5, 'The Appam & Stew is ethereal. I\'ve come back three times this month just for this dish.', 1),
        (5, None, 9, 'Vikram Sundaram', 4, 'Ghee Podi Idli is addictive. The gun powder spice blend is clearly hand-ground — you can taste the difference.', 1),
    ]
    c.executemany("INSERT OR IGNORE INTO reviews (id,user_id,menu_item_id,name,rating,comment,is_approved) VALUES (?,?,?,?,?,?,?)", reviews)

    # Seed admin user
    pwd = hashlib.sha256("admin123".encode()).hexdigest()
    c.execute("INSERT OR IGNORE INTO users (name,email,password_hash,role) VALUES ('Admin','admin@tiffintales.com',?,'admin')", (pwd,))

    db.commit()
    db.close()
    print("✅ Database initialised with seed data")

# ─────────────────────────────────────────
# AUTH HELPERS
# ─────────────────────────────────────────
def make_token(user_id, role):
    payload = {
        'user_id': user_id,
        'role': role,
        'exp': time.time() + 86400  # 24h
    }
    data = base64.b64encode(json.dumps(payload).encode()).decode()
    sig = hmac.new(SECRET_KEY.encode(), data.encode(), hashlib.sha256).hexdigest()
    return f"{data}.{sig}"

def verify_token(token):
    try:
        data, sig = token.rsplit('.', 1)
        expected = hmac.new(SECRET_KEY.encode(), data.encode(), hashlib.sha256).hexdigest()
        if not hmac.compare_digest(sig, expected):
            return None
        payload = json.loads(base64.b64decode(data).decode())
        if payload['exp'] < time.time():
            return None
        return payload
    except:
        return None

def token_required(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        auth = request.headers.get('Authorization', '')
        token = auth.replace('Bearer ', '')
        payload = verify_token(token)
        if not payload:
            return jsonify({'error': 'Invalid or expired token'}), 401
        g.user = payload
        return f(*args, **kwargs)
    return decorated

def admin_required(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        auth = request.headers.get('Authorization', '')
        token = auth.replace('Bearer ', '')
        payload = verify_token(token)
        if not payload or payload.get('role') != 'admin':
            return jsonify({'error': 'Admin access required'}), 403
        g.user = payload
        return f(*args, **kwargs)
    return decorated

def row_to_dict(row):
    if row is None: return None
    return dict(row)

def rows_to_list(rows):
    return [dict(r) for r in rows]

# ─────────────────────────────────────────
# AUTH ROUTES
# ─────────────────────────────────────────
@app.route('/api/auth/register', methods=['POST'])
def register():
    data = request.get_json()
    name = data.get('name','').strip()
    email = data.get('email','').strip().lower()
    password = data.get('password','')
    phone = data.get('phone','')

    if not name or not email or len(password) < 6:
        return jsonify({'error': 'Name, email and password (min 6 chars) required'}), 400

    pwd_hash = hashlib.sha256(password.encode()).hexdigest()
    db = get_db()
    try:
        cur = db.execute(
            "INSERT INTO users (name,email,password_hash,phone) VALUES (?,?,?,?)",
            (name, email, pwd_hash, phone)
        )
        db.commit()
        token = make_token(cur.lastrowid, 'customer')
        return jsonify({'token': token, 'user': {'id': cur.lastrowid, 'name': name, 'email': email, 'role': 'customer'}}), 201
    except sqlite3.IntegrityError:
        return jsonify({'error': 'Email already registered'}), 409

@app.route('/api/auth/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email','').strip().lower()
    password = data.get('password','')
    pwd_hash = hashlib.sha256(password.encode()).hexdigest()
    db = get_db()
    user = row_to_dict(db.execute("SELECT * FROM users WHERE email=? AND password_hash=?", (email, pwd_hash)).fetchone())
    if not user:
        return jsonify({'error': 'Invalid email or password'}), 401
    token = make_token(user['id'], user['role'])
    return jsonify({'token': token, 'user': {'id': user['id'], 'name': user['name'], 'email': user['email'], 'role': user['role']}})

@app.route('/api/auth/me', methods=['GET'])
@token_required
def me():
    db = get_db()
    user = row_to_dict(db.execute("SELECT id,name,email,phone,role,created_at FROM users WHERE id=?", (g.user['user_id'],)).fetchone())
    return jsonify(user)

# ─────────────────────────────────────────
# MENU ROUTES
# ─────────────────────────────────────────
@app.route('/api/categories', methods=['GET'])
def get_categories():
    db = get_db()
    cats = rows_to_list(db.execute("SELECT * FROM categories ORDER BY sort_order").fetchall())
    return jsonify(cats)

@app.route('/api/menu', methods=['GET'])
def get_menu():
    db = get_db()
    category = request.args.get('category')
    featured = request.args.get('featured')
    search = request.args.get('search','')
    page = int(request.args.get('page', 1))
    per_page = int(request.args.get('per_page', 20))
    offset = (page - 1) * per_page

    where, params = ["m.is_available = 1"], []
    if category:
        where.append("c.slug = ?"); params.append(category)
    if featured:
        where.append("m.is_featured = 1")
    if search:
        where.append("(m.name LIKE ? OR m.description LIKE ?)"); params += [f'%{search}%', f'%{search}%']

    sql = f"""
        SELECT m.*, c.name as category_name, c.slug as category_slug
        FROM menu_items m JOIN categories c ON m.category_id = c.id
        WHERE {' AND '.join(where)}
        ORDER BY m.is_featured DESC, m.total_orders DESC
        LIMIT ? OFFSET ?
    """
    items = rows_to_list(db.execute(sql, params + [per_page, offset]).fetchall())
    total = db.execute(f"SELECT COUNT(*) FROM menu_items m JOIN categories c ON m.category_id=c.id WHERE {' AND '.join(where)}", params).fetchone()[0]
    return jsonify({'items': items, 'total': total, 'page': page, 'per_page': per_page, 'pages': (total + per_page - 1) // per_page})

@app.route('/api/menu/<slug>', methods=['GET'])
def get_menu_item(slug):
    db = get_db()
    item = row_to_dict(db.execute("""
        SELECT m.*, c.name as category_name FROM menu_items m 
        JOIN categories c ON m.category_id=c.id WHERE m.slug=?
    """, (slug,)).fetchone())
    if not item: return jsonify({'error': 'Item not found'}), 404
    reviews = rows_to_list(db.execute("SELECT * FROM reviews WHERE menu_item_id=? AND is_approved=1 ORDER BY created_at DESC LIMIT 10", (item['id'],)).fetchall())
    item['reviews'] = reviews
    return jsonify(item)

@app.route('/api/menu', methods=['POST'])
@admin_required
def create_menu_item():
    data = request.get_json()
    db = get_db()
    slug = data['name'].lower().replace(' ', '-').replace("'", '')
    cur = db.execute("""
        INSERT INTO menu_items (category_id,name,slug,description,price,image_url,tag,badge,is_spicy,is_vegan,is_featured)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)
    """, (data['category_id'], data['name'], slug, data.get('description'), data['price'],
          data.get('image_url'), data.get('tag'), data.get('badge'), data.get('is_spicy',0),
          data.get('is_vegan',1), data.get('is_featured',0)))
    db.commit()
    return jsonify({'id': cur.lastrowid, 'message': 'Menu item created'}), 201

@app.route('/api/menu/<int:item_id>', methods=['PUT'])
@admin_required
def update_menu_item(item_id):
    data = request.get_json()
    db = get_db()
    allowed = ['name','description','price','image_url','tag','badge','is_spicy','is_vegan','is_available','is_featured','category_id']
    sets = [f"{k}=?" for k in data if k in allowed]
    vals = [data[k] for k in data if k in allowed]
    if not sets: return jsonify({'error': 'Nothing to update'}), 400
    db.execute(f"UPDATE menu_items SET {', '.join(sets)} WHERE id=?", vals + [item_id])
    db.commit()
    return jsonify({'message': 'Updated'})

@app.route('/api/menu/<int:item_id>', methods=['DELETE'])
@admin_required
def delete_menu_item(item_id):
    get_db().execute("DELETE FROM menu_items WHERE id=?", (item_id,))
    get_db().commit()
    return jsonify({'message': 'Deleted'})

# ─────────────────────────────────────────
# RESERVATION ROUTES
# ─────────────────────────────────────────
@app.route('/api/reservations', methods=['POST'])
def create_reservation():
    data = request.get_json()
    required = ['name','email','phone','date','time','guests']
    for f in required:
        if not data.get(f):
            return jsonify({'error': f'{f} is required'}), 400
    db = get_db()
    uid = g.user.get('user_id') if hasattr(g, 'user') else None
    cur = db.execute("""
        INSERT INTO reservations (user_id,name,email,phone,date,time,guests,occasion,special_requests)
        VALUES (?,?,?,?,?,?,?,?,?)
    """, (uid, data['name'], data['email'], data['phone'], data['date'], data['time'],
          data['guests'], data.get('occasion'), data.get('special_requests')))
    db.commit()
    return jsonify({'id': cur.lastrowid, 'message': 'Reservation confirmed! We will contact you shortly.'}), 201

@app.route('/api/reservations', methods=['GET'])
@admin_required
def get_reservations():
    db = get_db()
    status = request.args.get('status')
    where = "WHERE status=?" if status else ""
    params = [status] if status else []
    rows = rows_to_list(db.execute(f"SELECT * FROM reservations {where} ORDER BY date DESC, time DESC", params).fetchall())
    return jsonify(rows)

@app.route('/api/reservations/<int:rid>', methods=['PUT'])
@admin_required
def update_reservation(rid):
    data = request.get_json()
    db = get_db()
    db.execute("UPDATE reservations SET status=? WHERE id=?", (data['status'], rid))
    db.commit()
    return jsonify({'message': 'Updated'})

# ─────────────────────────────────────────
# ORDER ROUTES
# ─────────────────────────────────────────
@app.route('/api/orders', methods=['POST'])
def create_order():
    data = request.get_json()
    items = data.get('items', [])
    if not items: return jsonify({'error': 'No items in order'}), 400
    subtotal = sum(i['price'] * i['qty'] for i in items)
    tax = round(subtotal * 0.05, 2)
    total = subtotal + tax
    db = get_db()
    uid = g.user.get('user_id') if hasattr(g, 'user') else None
    cur = db.execute("""
        INSERT INTO orders (user_id,guest_name,guest_email,guest_phone,items_json,subtotal,tax,total,order_type,notes)
        VALUES (?,?,?,?,?,?,?,?,?,?)
    """, (uid, data.get('name'), data.get('email'), data.get('phone'),
          json.dumps(items), subtotal, tax, total,
          data.get('order_type','dine-in'), data.get('notes')))
    # Update total_orders for items
    for item in items:
        db.execute("UPDATE menu_items SET total_orders=total_orders+? WHERE id=?", (item['qty'], item['id']))
    db.commit()
    return jsonify({'id': cur.lastrowid, 'total': total, 'message': 'Order placed successfully!'}), 201

@app.route('/api/orders', methods=['GET'])
@admin_required
def get_orders():
    db = get_db()
    rows = rows_to_list(db.execute("SELECT * FROM orders ORDER BY created_at DESC LIMIT 100").fetchall())
    return jsonify(rows)

@app.route('/api/orders/<int:oid>', methods=['PUT'])
@admin_required
def update_order(oid):
    data = request.get_json()
    get_db().execute("UPDATE orders SET status=? WHERE id=?", (data['status'], oid))
    get_db().commit()
    return jsonify({'message': 'Updated'})

# ─────────────────────────────────────────
# REVIEWS
# ─────────────────────────────────────────
@app.route('/api/reviews', methods=['GET'])
def get_reviews():
    db = get_db()
    rows = rows_to_list(db.execute("SELECT * FROM reviews WHERE is_approved=1 ORDER BY created_at DESC LIMIT 20").fetchall())
    return jsonify(rows)

@app.route('/api/reviews', methods=['POST'])
def create_review():
    data = request.get_json()
    if not data.get('name') or not data.get('rating') or not data.get('comment'):
        return jsonify({'error': 'Name, rating, and comment required'}), 400
    db = get_db()
    uid = g.user.get('user_id') if hasattr(g, 'user') else None
    cur = db.execute(
        "INSERT INTO reviews (user_id,menu_item_id,name,rating,comment) VALUES (?,?,?,?,?)",
        (uid, data.get('menu_item_id'), data['name'], data['rating'], data['comment'])
    )
    db.commit()
    return jsonify({'id': cur.lastrowid, 'message': 'Review submitted. Thank you!'}), 201

# ─────────────────────────────────────────
# CONTACT & NEWSLETTER
# ─────────────────────────────────────────
@app.route('/api/contact', methods=['POST'])
def contact():
    data = request.get_json()
    if not data.get('name') or not data.get('email') or not data.get('message'):
        return jsonify({'error': 'Name, email and message required'}), 400
    db = get_db()
    db.execute("INSERT INTO contact_messages (name,email,subject,message) VALUES (?,?,?,?)",
               (data['name'], data['email'], data.get('subject'), data['message']))
    db.commit()
    return jsonify({'message': 'Message sent! We will get back to you within 24 hours.'}), 201

@app.route('/api/newsletter', methods=['POST'])
def newsletter():
    data = request.get_json()
    email = data.get('email','').strip().lower()
    if '@' not in email:
        return jsonify({'error': 'Valid email required'}), 400
    try:
        get_db().execute("INSERT INTO newsletter_subscribers (email) VALUES (?)", (email,))
        get_db().commit()
        return jsonify({'message': '🎉 Welcome to the Tiffin Tales family!'}), 201
    except sqlite3.IntegrityError:
        return jsonify({'message': 'Already subscribed!'}), 200

# ─────────────────────────────────────────
# ADMIN DASHBOARD STATS
# ─────────────────────────────────────────
@app.route('/api/admin/stats', methods=['GET'])
@admin_required
def admin_stats():
    db = get_db()
    stats = {
        'total_orders': db.execute("SELECT COUNT(*) FROM orders").fetchone()[0],
        'pending_orders': db.execute("SELECT COUNT(*) FROM orders WHERE status='pending'").fetchone()[0],
        'total_revenue': db.execute("SELECT COALESCE(SUM(total),0) FROM orders WHERE status!='cancelled'").fetchone()[0],
        'total_reservations': db.execute("SELECT COUNT(*) FROM reservations").fetchone()[0],
        'pending_reservations': db.execute("SELECT COUNT(*) FROM reservations WHERE status='pending'").fetchone()[0],
        'total_users': db.execute("SELECT COUNT(*) FROM users WHERE role='customer'").fetchone()[0],
        'total_menu_items': db.execute("SELECT COUNT(*) FROM menu_items").fetchone()[0],
        'newsletter_subs': db.execute("SELECT COUNT(*) FROM newsletter_subscribers").fetchone()[0],
        'unread_messages': db.execute("SELECT COUNT(*) FROM contact_messages WHERE is_read=0").fetchone()[0],
        'top_items': rows_to_list(db.execute(
            "SELECT name, total_orders, rating FROM menu_items ORDER BY total_orders DESC LIMIT 5"
        ).fetchall()),
        'recent_orders': rows_to_list(db.execute(
            "SELECT id, guest_name, total, status, created_at FROM orders ORDER BY created_at DESC LIMIT 5"
        ).fetchall()),
    }
    return jsonify(stats)

@app.route('/api/admin/users', methods=['GET'])
@admin_required
def admin_users():
    db = get_db()
    rows = rows_to_list(db.execute("SELECT id,name,email,phone,role,created_at FROM users ORDER BY created_at DESC").fetchall())
    return jsonify(rows)

@app.route('/api/admin/messages', methods=['GET'])
@admin_required
def admin_messages():
    db = get_db()
    rows = rows_to_list(db.execute("SELECT * FROM contact_messages ORDER BY created_at DESC").fetchall())
    return jsonify(rows)

# ─────────────────────────────────────────
# SERVE FRONTEND
# ─────────────────────────────────────────
@app.route('/')
def index():
    return send_from_directory('public', 'index.html')

@app.route('/admin')
def admin_page():
    return send_from_directory('public', 'admin.html')

@app.errorhandler(404)
def not_found(e):
    return jsonify({'error': 'Not found'}), 404

if __name__ == '__main__':
    init_db()
    print("🍛 Tiffin Tales API running on http://localhost:5000")
    app.run(debug=True, port=5000)