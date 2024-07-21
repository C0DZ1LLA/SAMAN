window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'G-JGE32M12GV');

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "flex";
    modal.children[0].classList.add("fadeIn");
    modal.children[0].classList.remove("fadeOut");
    currentModal = modal;
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "none";
    if (modalId === "translateModal") {
        const translateElement = document.getElementById("google_translate_element");
        translateElement.innerHTML = ''; // Clear previous Google Translate widget content
    }
}

window.addEventListener("click", (event) => {
    if (
        event.target.classList.contains('modal-content') &&
        !event.target.closest('.modal-content').contains(event.target)
    ) {
        closeModal(event.target.id);
    }
});

let currentModal = null;

const toggleModal = (id) => {
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

function openEmailApp(email) {
    window.location.href = "mailto:" + email;
}

function openPhoneApp(phone) {
    window.location.href = "tel:" + phone;
}

function matrixRain() {
    const canvas = document.getElementById('matrixCanvas');
    const ctx = canvas.getContext('2d');

    function setCanvasDimensions() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    setCanvasDimensions();

    let columns = Math.floor(canvas.width / 20);
    let drops = [];
    for (let i = 0; i < columns; i++) {
        drops[i] = {
            y: Math.floor(Math.random() * canvas.height),
            speed: Math.random() * 3 + 1,
            size: Math.random() * 10 + 10
        };
    }

    function draw() {
        ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.textAlign = 'center';
        for (let i = 0; i < drops.length; i++) {
            const character = generateRandomCharacter();
            const color = generateRandomColor();
            const depth = drops[i].y / canvas.height;
            const fontSize = (depth * 20) + 10;
            ctx.font = `italic bold ${fontSize}px "Consolas", monospace`;
            ctx.fillStyle = color;
            ctx.fillText(character, i * 20, drops[i].y);
            drops[i].y += drops[i].speed;
            if (drops[i].y > canvas.height && Math.random() > 0.95) {
                drops[i].y = 0;
            }
        }
    }

    window.addEventListener('resize', function () {
        setCanvasDimensions();
        columns = Math.floor(canvas.width / 20);
        drops = [];
        for (let i = 0; i < columns; i++) {
            drops[i] = {
                y: Math.floor(Math.random() * canvas.height),
                speed: Math.random() * 3 + 1,
                size: Math.random() * 10 + 10
            };
        }
    });

    setInterval(draw, 50);
}

window.onload = function () {
    matrixRain();
};

function openURL(url) {
    window.open(url, '_blank');
}

function generateRandomCharacter() {
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    return characters.charAt(Math.floor(Math.random() * characters.length));
}

function generateRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function loadGoogleTranslate() {
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    document.body.appendChild(script);
}

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'af,sq,am,ar,hy,az,eu,be,bn,bg,ca,ceb,zh-CN,zh-TW,co,hr,cs,da,nl,en,eo,et,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,he,hi,hmn,hu,is,ig,id,ga,it,ja,jv,kn,kk,km,rw,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ny,or,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,si,sk,sl,so,es,su,sw,sv,tg,ta,tt,te,th,tr,tur,uk,ur,uz,vi,cy,xh,yi,yo,zu',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
}
