<?php 
require_once 'includes/db.php';
require_once 'includes/header.php';
?>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Welcome to Travel Translator</h2>
    <p class="text-gray-700 mb-4">Your ultimate companion for seamless communication while traveling abroad. Translate text, speech, and even images in real-time.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Translation Card -->
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
            <div class="flex items-center mb-3">
                <i class="fas fa-exchange-alt text-blue-600 text-2xl mr-3"></i>
                <h3 class="text-lg font-semibold text-blue-800">Text Translation</h3>
            </div>
            <p class="text-gray-700 mb-3">Translate between 100+ languages with our accurate AI-powered translator.</p>
            <div class="mt-4">
                <form id="translation-form">
                    <div class="mb-3">
                        <select id="source-language" class="w-full p-2 border rounded">
                            <option value="auto">Detect Language</option>
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="it">Italian</option>
                            <option value="ja">Japanese</option>
                            <option value="zh">Chinese</option>
                            <option value="ko">Korean</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea id="source-text" class="w-full p-2 border rounded h-24" placeholder="Enter text to translate"></textarea>
                    </div>
                    <div class="mb-3">
                        <select id="target-language" class="w-full p-2 border rounded">
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="it">Italian</option>
                            <option value="ja">Japanese</option>
                            <option value="zh">Chinese</option>
                            <option value="ko">Korean</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                        Translate
                    </button>
                </form>
                <div id="translation-result" class="mt-4 p-3 bg-gray-100 rounded hidden">
                    <h4 class="font-semibold mb-2">Translation:</h4>
                    <p id="translated-text" class="text-gray-800"></p>
                    <div class="mt-2 flex justify-between">
                        <button id="copy-translation" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-copy mr-1"></i> Copy
                        </button>
                        <button id="save-phrase" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-save mr-1"></i> Save
                        </button>
                        <button id="speak-translation" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-volume-up mr-1"></i> Speak
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Phrasebook Card -->
        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
            <div class="flex items-center mb-3">
                <i class="fas fa-book text-green-600 text-2xl mr-3"></i>
                <h3 class="text-lg font-semibold text-green-800">Smart Phrasebook</h3>
            </div>
            <p class="text-gray-700 mb-3">Generate essential phrases based on your destination and travel context.</p>
            <form id="phrasebook-form" class="mt-4">
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1">Destination Language</label>
                    <select id="phrasebook-language" class="w-full p-2 border rounded">
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                        <option value="it">Italian</option>
                        <option value="ja">Japanese</option>
                        <option value="zh">Chinese</option>
                        <option value="ko">Korean</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1">Travel Context</label>
                    <select id="travel-context" class="w-full p-2 border rounded">
                        <option value="vacation">Vacation</option>
                        <option value="business">Business</option>
                        <option value="medical">Medical</option>
                        <option value="backpacking">Backpacking</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                    Generate Phrasebook
                </button>
            </form>
            <div id="phrasebook-result" class="mt-4 hidden">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold">Generated Phrases</h4>
                    <button id="download-phrasebook" class="text-green-600 hover:text-green-800">
                        <i class="fas fa-download mr-1"></i> Download PDF
                    </button>
                </div>
                <div id="phrases-list" class="bg-white p-3 rounded border max-h-60 overflow-y-auto">
                    <!-- Phrases will be loaded here -->
                </div>
            </div>
        </div>
        
        <!-- Features Card -->
        <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
            <div class="flex items-center mb-3">
                <i class="fas fa-star text-purple-600 text-2xl mr-3"></i>
                <h3 class="text-lg font-semibold text-purple-800">App Features</h3>
            </div>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Real-time text translation</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Conversation mode for live translations</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Camera translation for signs and menus</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Smart phrasebook generator</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Offline access to saved phrases</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-purple-500 mt-1 mr-2"></i>
                    <span>Text-to-speech pronunciation</span>
                </li>
            </ul>
            <div class="mt-6">
                <a href="/live-translate.php" class="block w-full bg-purple-600 text-white py-2 px-4 rounded text-center hover:bg-purple-700 transition mb-2">
                    <i class="fas fa-comments mr-2"></i> Try Live Translate
                </a>
                <a href="/camera-translate.php" class="block w-full bg-purple-600 text-white py-2 px-4 rounded text-center hover:bg-purple-700 transition">
                    <i class="fas fa-camera mr-2"></i> Try Camera Translate
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Translations Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-blue-700 mb-4 flex items-center">
        <i class="fas fa-history mr-2"></i> Your Recent Translations
    </h2>
    <div id="recent-translations" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Recent translations will be loaded here -->
        <div class="text-gray-500 italic">No recent translations yet</div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>