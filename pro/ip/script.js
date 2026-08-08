// Sample iPhone data
const products = [
    { id: 1, name: 'iPhone 15 Pro Max', price: 159900, image: './image/a15 pro.jpg', specs: 'A17 Pro chip, 256GB, Titanium, 6.7" Display', storage: '256GB', feature: 'camera' },
    { id: 2, name: 'iPhone 15 Pro', price: 129900, image: './image/a15 pro.jpg', specs: 'A17 Pro chip, 128GB, Titanium', storage: '128GB', feature: 'performance' },
    { id: 3, name: 'iPhone 15 Plus', price: 89900, image: './image/a15 plus.webp', specs: 'A16 Bionic, 128GB, 6.7" Display, Dynamic Island', storage: '128GB', feature: 'battery' },
    { id: 4, name: 'iPhone 15', price: 79900, image: './image/a15.webp', specs: 'A16 Bionic, 128GB, Dynamic Island', storage: '128GB', feature: 'value' },
    { id: 5, name: 'iPhone 14 Pro Max', price: 139900, image: './image/dis3.png', specs: 'A16 Bionic, 256GB, 6.7" Display, Pro camera', storage: '256GB', feature: 'camera' },
    { id: 6, name: 'iPhone 14 Pro', price: 119900, image: './image/app2.jpg', specs: 'A16 Bionic, 128GB, Pro camera', storage: '128GB', feature: 'performance' },
    { id: 7, name: 'iPhone 14 Plus', price: 79900, image: './image/app.jpg', specs: 'A15 Bionic, 128GB, 6.7" Display, All-day battery', storage: '128GB', feature: 'battery' },
    { id: 8, name: 'iPhone 14', price: 69900, image: './image/app1.jpg', specs: 'A15 Bionic, 128GB, Great battery', storage: '128GB', feature: 'value' },
    { id: 9, name: 'iPhone 13 Pro Max', price: 129900, image: './image/dis5.png', specs: 'A15 Bionic, 256GB, 6.7" Display, Pro camera', storage: '256GB', feature: 'camera' },
    { id: 10, name: 'iPhone 13', price: 59900, image: './image/display1.jpg', specs: 'A15 Bionic, 128GB, Reliable', storage: '128GB', feature: 'value' },
    { id: 11, name: 'iPhone SE (3rd gen)', price: 49900, image: './image/a pink.webp', specs: 'A15 Bionic, 64GB, Compact', storage: '64GB', feature: 'budget' },
    { id: 12, name: 'iPhone 12', price: 54900, image: './image/display2.jpg', specs: 'A14 Bionic, 64GB, Ceramic Shield', storage: '64GB', feature: 'value' }
];

let filteredProducts = [...products];

// --- PRODUCT LOADING LOGIC ---
function loadProducts() {
    const productsContainer = document.getElementById('productsContainer');
    if(!productsContainer) return; // Guard for pages without product container
    
    productsContainer.innerHTML = '';
    filteredProducts.forEach(product => {
        const productHTML = `
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white">
                    <img src="${product.image}" class="card-img-top" alt="${product.name}">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">${product.specs}</p>
                        <p class="card-text"><strong>₹${product.price.toLocaleString('en-IN')}</strong></p>
                        <a href="product.php?id=${product.id}" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
                        <a href="add_to_cart.php?id=${product.id}" class="btn btn-secondary"><i class="fas fa-cart-plus"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
        `;
        productsContainer.innerHTML += productHTML;
    });
    document.getElementById('productCount').textContent = `${filteredProducts.length} products`;
}

function applyFilters() {
    const priceRange = document.getElementById('priceRange').value;
    const storageFilter = document.getElementById('storageFilter').value;
    const sortBy = document.getElementById('sortBy').value;

    filteredProducts = products.filter(product => {
        return product.price <= priceRange && (storageFilter === '' || product.storage === storageFilter);
    });

    if (sortBy === 'price-low') filteredProducts.sort((a, b) => a.price - b.price);
    else if (sortBy === 'price-high') filteredProducts.sort((a, b) => b.price - a.price);

    loadProducts();
}

// --- CHATBOT LOGIC ---
// 1. Unified Element Selection
const chatMessages = document.getElementById('chat-messages');
const chatInput = document.getElementById('chat-input');
const sendChat = document.getElementById('send-chat');
const chatToggle = document.getElementById('chat-toggle');
const chatbot = document.getElementById('chatbot');
const closeChat = document.getElementById('close-chat');

// 2. Open/Close Logic
chatToggle.addEventListener('click', () => {
    chatbot.style.display = 'flex';
    chatToggle.style.display = 'none';
});

closeChat.addEventListener('click', () => {
    chatbot.style.display = 'none';
    chatToggle.style.display = 'flex';
});

// 3. Recommendation Logic (API Simulation)
function getRecommendation(input) {
    const text = input.toLowerCase();
    if (text.includes("cheap") || text.includes("budget")) {
        return "Based on your budget, I recommend the iPhone SE (₹49,900). It's powerful yet affordable!";
    } 
    if (text.includes("camera") || text.includes("photo")) {
        return "If you love photography, the iPhone 15 Pro Max is the ultimate choice with its 5x Telephoto lens.";
    }
    if (text.includes("battery")) {
        return "The iPhone 15 Plus has the longest battery life in the current lineup. Perfect for heavy users!";
    }
    return "I'm here to help! Try asking about 'camera', 'budget', or 'battery life'.";
}

// 4. Message Handling
function showTyping() {
    const div = document.createElement('div');
    div.className = 'message bot typing-indicator animate-msg';
    div.id = 'typing';
    div.innerHTML = '<span></span><span></span><span></span>';
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function addChatMessage(text, sender) {
    const typing = document.getElementById('typing');
    if (typing) typing.remove();

    const div = document.createElement('div');
    div.className = `message ${sender} animate-msg`;
    div.innerText = text;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// 5. Send Event
sendChat.addEventListener('click', () => {
    const msg = chatInput.value.trim();
    if (!msg) return;

    addChatMessage(msg, 'user');
    chatInput.value = '';

    showTyping();
    setTimeout(() => {
        const reply = getRecommendation(msg);
        addChatMessage(reply, 'bot');
    }, 1200);
});

chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendChat.click();
});

// Global Function for Quick Buttons (must be global for onclick)
window.sendQuickMsg = function(text) {
    chatInput.value = text;
    sendChat.click();
};

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    if(document.getElementById('productsContainer')) {
        loadProducts();
        document.getElementById('priceRange').addEventListener('input', applyFilters);
        document.getElementById('storageFilter').addEventListener('change', applyFilters);
        document.getElementById('sortBy').addEventListener('change', applyFilters);
    }
});
function revealSections() {
    const reveals = document.querySelectorAll('.reveal, .reveal-right');
    const windowHeight = window.innerHeight;
    const revealPoint = 100; // Pixels from bottom before triggering

    reveals.forEach(element => {
        const revealTop = element.getBoundingClientRect().top;

        if (revealTop < windowHeight - revealPoint) {
            element.classList.add('active');
        }
    });
}

// Run on scroll
window.addEventListener('scroll', revealSections);

// Run once on load in case the user is already mid-page
document.addEventListener('DOMContentLoaded', revealSections);