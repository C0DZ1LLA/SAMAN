document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    emailjs.sendForm('service_5zwkzis', 'template_u8dvt3m', this)
        .then(function() {
            alert('Message sent successfully!');
        }, function(error) {
            alert('Failed to send the message. Please try again.');
            console.log('FAILED...', error);
        });
});


function toggleModal(id) {
    const modal = document.getElementById(id);
    if (currentModal !== null && currentModal !== modal) {
        currentModal.style.display = "none";
        currentModal.children[0].classList.remove("fadeIn");
        currentModal.children[0].classList.add("fadeOut");
    }
    modal.style.display = modal.style.display === "flex" ? "none" : "flex";
    modal.children[0].classList.toggle("fadeIn");
    modal.children[0].classList.toggle("fadeOut");
    currentModal = modal.style.display === "flex" ? modal : null;

    if (id === 'translateModal') {
        loadGoogleTranslate();
    }
}


// Theme switcher functionality
function switchTheme(theme) {
    if (theme === 'dark') {
        document.body.classList.remove('light-theme');
        document.body.classList.add('dark-theme');
    } else if (theme === 'light') {
        document.body.classList.remove('dark-theme');
        document.body.classList.add('light-theme');
    }
}

// Background effect
const canvas = document.getElementById('backgroundCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const particles = [];
const particleCount = 100;
const colors = ['#00ffc6', '#00b3ff', '#00ff92'];

for (let i = 0; i < particleCount; i++) {
    particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.random() * 2 + 1,
        color: colors[Math.floor(Math.random() * colors.length)],
        speed: Math.random() * 0.5 + 0.5,
    });
}

function animateParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    particles.forEach(particle => {
        ctx.beginPath();
        ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2, false);
        ctx.fillStyle = particle.color;
        ctx.fill();

        particle.y -= particle.speed;

        if (particle.y < 0) {
            particle.y = canvas.height;
            particle.x = Math.random() * canvas.width;
        }
    });

    requestAnimationFrame(animateParticles);
}

animateParticles();

window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});

// Function to open URLs in a new tab
function openURL(url) {
    window.open(url, '_blank');
}

// Function to toggle modals
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
    if (modalId === 'translateModal') {
        loadGoogleTranslate();
    }
}

// Function to close modals
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
    if (modalId === 'translateModal') {
        const translateElement = document.getElementById("google_translate_element");
        translateElement.innerHTML = ''; // Clear previous Google Translate widget content
    }
}

// Function to open email app
function openEmailApp(email) {
    window.location.href = `mailto:${email}`;
}

// Function to open WhatsApp
function openPhoneApp(phone) {
    window.location.href = `https://wa.me/${phone}`;
}

// Event listeners for theme switcher buttons
document.querySelectorAll('#theme-switcher button').forEach(button => {
    button.addEventListener('click', () => {
        switchTheme(button.textContent.toLowerCase());
    });
});

// Initialization for Google Translate
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
}

function loadGoogleTranslate() {
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    document.body.appendChild(script);
}

// Adding event listeners to close buttons in modals
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.addEventListener('click', (event) => {
        const modal = event.target.closest('.modal');
        if (modal) {
            modal.style.display = 'none';
        }
    });
});
