<?php 
require_once 'includes/db.php';
require_once 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold text-blue-700 mb-4 flex items-center">
        <i class="fas fa-comments mr-2"></i> Live Conversation Translator
    </h2>
    <p class="text-gray-700 mb-6">Have a real-time conversation with someone who speaks a different language. Speak or type and the translation will appear instantly.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Language Selection -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Language Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-1">Your Language</label>
                    <select id="user-language" class="w-full p-2 border rounded">
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
                <div>
                    <label class="block text-gray-700 mb-1">Their Language</label>
                    <select id="their-language" class="w-full p-2 border rounded">
                        <option value="es">Spanish</option>
                        <option value="en">English</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                        <option value="it">Italian</option>
                        <option value="ja">Japanese</option>
                        <option value="zh">Chinese</option>
                        <option value="ko">Korean</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Conversation Context</label>
                    <select id="conversation-context" class="w-full p-2 border rounded">
                        <option value="general">General</option>
                        <option value="restaurant">Restaurant</option>
                        <option value="hotel">Hotel</option>
                        <option value="transport">Transportation</option>
                        <option value="shopping">Shopping</option>
                        <option value="medical">Medical</option>
                    </select>
                </div>
                <button id="start-conversation" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    <i class="fas fa-play mr-2"></i> Start Conversation
                </button>
            </div>
        </div>
        
        <!-- Conversation Area -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Conversation</h3>
            <div id="conversation-container" class="hidden">
                <div class="flex space-x-4 mb-4">
                    <button id="user-speak" class="flex-1 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                        <i class="fas fa-microphone mr-2"></i> Speak (Your Language)
                    </button>
                    <button id="their-speak" class="flex-1 bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition">
                        <i class="fas fa-microphone mr-2"></i> Speak (Their Language)
                    </button>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Type your message</label>
                    <div class="flex">
                        <input type="text" id="user-message" class="flex-1 p-2 border rounded-l" placeholder="Type here...">
                        <button id="send-user-message" class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Type their message</label>
                    <div class="flex">
                        <input type="text" id="their-message" class="flex-1 p-2 border rounded-l" placeholder="Type here...">
                        <button id="send-their-message" class="bg-purple-600 text-white px-4 rounded-r hover:bg-purple-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                
                <div class="border rounded-lg p-3 bg-white max-h-96 overflow-y-auto" id="conversation-history">
                    <!-- Conversation will appear here -->
                    <div class="text-center text-gray-500 italic py-4">Conversation will appear here</div>
                </div>
                
                <div class="mt-4 flex justify-between">
                    <button id="save-conversation" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-save mr-1"></i> Save Conversation
                    </button>
                    <button id="clear-conversation" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash mr-1"></i> Clear
                    </button>
                </div>
            </div>
            
            <div id="conversation-instructions" class="text-center py-8">
                <div class="inline-block p-4 bg-blue-100 rounded-full mb-3">
                    <i class="fas fa-comments text-blue-600 text-3xl"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-700 mb-2">Start a Conversation</h4>
                <p class="text-gray-600">Select your languages and conversation context, then click "Start Conversation" to begin.</p>
            </div>
        </div>
    </div>
</div>

<!-- Common Phrases Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-blue-700 mb-4 flex items-center">
        <i class="fas fa-lightbulb mr-2"></i> Suggested Phrases
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="suggested-phrases">
        <!-- Phrases will be loaded based on context -->
    </div>
</div>

<script src="/assets/js/live-translate.js"></script>
<?php require_once 'includes/footer.php'; ?>