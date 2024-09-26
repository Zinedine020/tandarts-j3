// Wacht tot de volledige pagina geladen is
document.addEventListener('DOMContentLoaded', () => {
    // Voorbeeld: Formuliervalidatie
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const inputs = form.querySelectorAll('input, textarea, select');
            let valid = true;

            inputs.forEach(input => {
                if (input.required && !input.value) {
                    valid = false;
                    input.style.border = '1px solid red';
                } else {
                    input.style.border = '';
                }
            });

            if (!valid) {
                event.preventDefault();
                alert('Vul alle verplichte velden in.');
            }
        });
    });

    // Voorbeeld: Dynamische updates op basis van gebruikersinput
    const languageSelect = document.querySelector('select[name="language"]');
    
    if (languageSelect) {
        languageSelect.addEventListener('change', () => {
            const selectedLanguage = languageSelect.value;
            alert(`Taal geselecteerd: ${selectedLanguage}`);
        });
    }
    
    // Voorbeeld: Scroll naar boven knop
    const scrollTopButton = document.createElement('button');
    scrollTopButton.textContent = 'Scroll naar boven';
    scrollTopButton.style.position = 'fixed';
    scrollTopButton.style.bottom = '10px';
    scrollTopButton.style.right = '10px';
    scrollTopButton.style.display = 'none';
    document.body.appendChild(scrollTopButton);

    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) {
            scrollTopButton.style.display = 'block';
        } else {
            scrollTopButton.style.display = 'none';
        }
    });

    scrollTopButton.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
