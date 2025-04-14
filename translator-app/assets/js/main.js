document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if(mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Translation form
    const translationForm = document.getElementById('translation-form');
    if(translationForm) {
        translationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            translateText();
        });
    }
    
    // Phrasebook form
    const phrasebookForm = document.getElementById('phrasebook-form');
    if(phrasebookForm) {
        phrasebookForm.addEventListener('submit', function(e) {
            e.preventDefault();
            generatePhrasebook();
        });
    }
    
    // Load recent translations if user is logged in
    if(document.getElementById('recent-translations')) {
        loadRecentTranslations();
    }
});

function translateText() {
    const sourceText = document.getElementById('source-text').value.trim();
    const sourceLang = document.getElementById('source-language').value;
    const targetLang = document.getElementById('target-language').value;
    
    if(!sourceText) {
        alert('Please enter text to translate');
        return;
    }
    
    const resultDiv = document.getElementById('translation-result');
    const translatedText = document.getElementById('translated-text');
    
    // Show loading state
    resultDiv.classList.remove('hidden');
    translatedText.textContent = 'Translating...';
    
    // In a real app, you would call your PHP API endpoint here
    // For demo purposes, we'll simulate a delay and show the original text
    setTimeout(() => {
        // This is where you would make an actual API call to your translation service
        // fetch('/api/translate.php', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //     },
        //     body: JSON.stringify({
        //         text: sourceText,
        //         source: sourceLang,
        //         target: targetLang
        //     })
        // })
        // .then(response => response.json())
        // .then(data => {
        //     translatedText.textContent = data.translatedText;
        //     saveRecentTranslation(sourceText, data.translatedText, sourceLang, targetLang);
        // })
        // .catch(error => {
        //     translatedText.textContent = 'Translation failed. Please try again.';
        //     console.error('Error:', error);
        // });
        
        // Demo translation (in a real app, this would come from the API)
        const demoTranslations = {
            'en-es': 'Este es un texto de demostración traducido al español.',
            'en-fr': 'Ceci est un texte de démonstration traduit en français.',
            'en-de': 'Dies ist ein Demonstrationstext, der ins Deutsche übersetzt wurde.',
            'en-it': 'Questo è un testo dimostrativo tradotto in italiano.',
            'en-ja': 'これは日本語に翻訳されたデモンストレーションテキストです。',
            'en-zh': '这是翻译成中文的演示文本。',
            'en-ko': '이것은 한국어로 번역된 데모 텍스트입니다.'
        };
        
        const translationKey = `${sourceLang === 'auto' ? 'en' : sourceLang}-${targetLang}`;
        const demoTranslation = demoTranslations[translationKey] || `[Demo] Translation to ${targetLang}: ${sourceText}`;
        
        translatedText.textContent = demoTranslation;
        saveRecentTranslation(sourceText, demoTranslation, sourceLang, targetLang);
    }, 800);
}

function saveRecentTranslation(original, translated, fromLang, toLang) {
    // In a real app, you would save this to the server
    // For demo, we'll just update the UI
    
    const recentTranslations = document.getElementById('recent-translations');
    if(!recentTranslations) return;
    
    // Get existing items or initialize empty array
    let items = JSON.parse(localStorage.getItem('recentTranslations') || '[]');
    
    // Add new translation
    items.unshift({
        original,
        translated,
        fromLang,
        toLang,
        timestamp: new Date().toISOString()
    });
    
    // Keep only the last 6 items
    if(items.length > 6) {
        items = items.slice(0, 6);
    }
    
    // Save to localStorage
    localStorage.setItem('recentTranslations', JSON.stringify(items));
    
    // Update UI
    updateRecentTranslationsUI(items);
}

function updateRecentTranslationsUI(items) {
    const container = document.getElementById('recent-translations');
    if(!container) return;
    
    if(items.length === 0) {
        container.innerHTML = '<div class="text-gray-500 italic">No recent translations yet</div>';
        return;
    }
    
    const languageNames = {
        'en': 'English',
        'es': 'Spanish',
        'fr': 'French',
        'de': 'German',
        'it': 'Italian',
        'ja': 'Japanese',
        'zh': 'Chinese',
        'ko': 'Korean',
        'auto': 'Auto Detect'
    };
    
    container.innerHTML = items.map(item => `
        <div class="bg-gray-50 p-3 rounded border">
            <div class="flex justify-between items-start mb-1">
                <span class="text-sm font-medium">${languageNames[item.fromLang]} → ${languageNames[item.toLang]}</span>
                <button class="text-blue-600 hover:text-blue-800 text-sm">
                    <