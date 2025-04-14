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
        <i class="fas fa-camera mr-2"></i> Camera Translation
    </h2>
    <p class="text-gray-700 mb-6">Point your camera at text (signs, menus, etc.) and get instant translations. You can also upload images.</p>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Camera/Upload Area -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Capture Text</h3>
            
            <div class="flex space-x-3 mb-4">
                <button id="start-camera" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    <i class="fas fa-camera mr-2"></i> Use Camera
                </button>
                <button id="upload-image" class="flex-1 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                    <i class="fas fa-upload mr-2"></i> Upload Image
                </button>
                <input type="file" id="image-upload" accept="image/*" class="hidden">
            </div>
            
            <div class="relative">
                <video id="camera-feed" class="w-full h-auto border rounded hidden" autoplay playsinline></video>
                <canvas id="canvas" class="w-full h-auto border rounded hidden"></canvas>
                <div id="camera-placeholder" class="w-full bg-gray-200 rounded flex items-center justify-center" style="height: 300px;">
                    <div class="text-center">
                        <i class="fas fa-camera text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Camera feed will appear here</p>
                    </div>
                </div>
                
                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-4">
                    <button id="capture-btn" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition hidden">
                        <i class="fas fa-circle"></i>
                    </button>
                    <button id="stop-camera" class="bg-gray-600 text-white p-2 rounded-full hover:bg-gray-700 transition hidden">
                        <i class="fas fa-stop"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Translation Results -->
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <h3 class="text-lg font-semibold text-green-800 mb-3">Translation Results</h3>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Source Language</label>
                <select id="camera-source-language" class="w-full p-2 border rounded">
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
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Target Language</label>
                <select id="camera-target-language" class="w-full p-2 border rounded">
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
            
            <button id="translate-image" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition mb-4">
                <i class="fas fa-language mr-2"></i> Translate Text
            </button>
            
            <div class="bg-white p-3 rounded border mb-3">
                <h4 class="font-semibold mb-2">Detected Text:</h4>
                <div id="detected-text" class="text-gray-800 min-h-20 p-2 bg-gray-50 rounded">
                    Text will appear here after capture
                </div>
            </div>
            
            <div class="bg-white p-3 rounded border">
                <h4 class="font-semibold mb-2">Translation:</h4>
                <div id="image-translation" class="text-gray-800 min-h-20 p-2 bg-gray-50 rounded">
                    Translation will appear here
                </div>
                <div class="mt-2 flex justify-between">
                    <button id="copy-image-translation" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-copy mr-1"></i> Copy
                    </button>
                    <button id="speak-image-translation" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-volume-up mr-1"></i> Speak
                    </button>
                    <button id="save-image-translation" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Translations Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-blue-700 flex items-center">
            <i class="fas fa-history mr-2"></i> Your Recent Image Translations
        </h2>
        <button id="clear-image-history" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash mr-1"></i> Clear History
        </button>
    </div>
    <div id="image-translation-history" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- History items will be loaded here -->
        <div class="text-gray-500 italic">No image translations yet</div>
    </div>
</div>

<script src="/assets/js/camera-translate.js"></script>
<?php require_once 'includes/footer.php'; ?>