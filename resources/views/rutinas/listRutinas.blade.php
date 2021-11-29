@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function mostrarEjercicios(rutina_id){
        if ($('#ejercicios_'+rutina_id).attr('hidden')) {
            $('#ejercicios_'+rutina_id).removeAttr('hidden');
        } else {
            $('#ejercicios_'+rutina_id).attr('hidden',"true");
        }
    };

    function añadirEjercicio(dia){
        var html = $(".copy").html();
        html = ($(html).find('select[name]').attr('name','ejercicios_'+dia+'[]')).prevObject;
        html = ($(html).find('input[name]').attr('name','repeticiones_'+dia+'[]')).prevObject;
        $("#"+dia).append(html);
    };

    function eliminarEjercicio(boton){
        $(boton).parents(".control-group .removable").remove();
    };

    function editarRutina(rutina_id){
        $('#rutina_seleccionada').val(rutina_id);
        $('#modal-edit').modal('show');
    };

    function diaDescanso(dia){
        var isHidden = $('#'+dia).is(":hidden");
        if (isHidden) {
            $('#'+dia).show();
            $('#descanso'+dia).removeClass("btn-primary");
            $('#descanso'+dia).addClass("btn-secondary");
        } else {
            $('#'+dia).hide();
            $('#descanso'+dia).removeClass("btn-secondary");
            $('#descanso'+dia).addClass("btn-primary");
        }
    };
</script>


{{-- fontawesome popup --}}
<script>

    var icons =
    {"fas": ['abacus', 'acorn', 'ad', 'address-book', 'address-card', 'adjust', 'air-freshener', 'alarm-clock', 'alarm-exclamation', 'alarm-plus', 'alarm-snooze', 'album', 'album-collection', 'alicorn', 'align-center', 'align-justify', 'align-left', 'align-right', 'align-slash', 'allergies', 'ambulance', 'american-sign-language-interpreting', 'amp-guitar', 'analytics', 'anchor', 'angel', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'angry', 'ankh', 'apple-alt', 'apple-crate', 'archive', 'archway', 'arrow-alt-circle-down', 'arrow-alt-circle-left', 'arrow-alt-circle-right', 'arrow-alt-circle-up', 'arrow-alt-down', 'arrow-alt-from-bottom', 'arrow-alt-from-left', 'arrow-alt-from-right', 'arrow-alt-from-top', 'arrow-alt-left', 'arrow-alt-right', 'arrow-alt-square-down', 'arrow-alt-square-left', 'arrow-alt-square-right', 'arrow-alt-square-up', 'arrow-alt-to-bottom', 'arrow-alt-to-left', 'arrow-alt-to-right', 'arrow-alt-to-top', 'arrow-alt-up', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-from-bottom', 'arrow-from-left', 'arrow-from-right', 'arrow-from-top', 'arrow-left', 'arrow-right', 'arrow-square-down', 'arrow-square-left', 'arrow-square-right', 'arrow-square-up', 'arrow-to-bottom', 'arrow-to-left', 'arrow-to-right', 'arrow-to-top', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-alt-h', 'arrows-alt-v', 'arrows-h', 'arrows-v', 'assistive-listening-systems', 'asterisk', 'at', 'atlas', 'atom', 'atom-alt', 'audio-description', 'award', 'axe', 'axe-battle', 'baby', 'baby-carriage', 'backpack', 'backspace', 'backward', 'bacon', 'badge', 'badge-check', 'badge-dollar', 'badge-percent', 'badge-sheriff', 'badger-honey', 'bags-shopping', 'balance-scale', 'balance-scale-left', 'balance-scale-right', 'ball-pile', 'ballot', 'ballot-check', 'ban', 'band-aid', 'banjo', 'barcode', 'barcode-alt', 'barcode-read', 'barcode-scan', 'bars', 'baseball', 'baseball-ball', 'basketball-ball', 'basketball-hoop', 'bat', 'bath', 'battery-bolt', 'battery-empty', 'battery-full', 'battery-half', 'battery-quarter', 'battery-slash', 'battery-three-quarters', 'bed', 'beer', 'bell', 'bell-exclamation', 'bell-plus', 'bell-school', 'bell-school-slash', 'bell-slash', 'bells', 'betamax', 'bezier-curve', 'bible', 'bicycle', 'biking', 'biking-mountain', 'binoculars', 'biohazard', 'birthday-cake', 'blanket', 'blender', 'blender-phone', 'blind', 'blog', 'bold', 'bolt', 'bomb', 'bone', 'bone-break', 'bong', 'book', 'book-alt', 'book-dead', 'book-heart', 'book-medical', 'book-open', 'book-reader', 'book-spells', 'book-user', 'bookmark', 'books', 'books-medical', 'boombox', 'boot', 'booth-curtain', 'border-all', 'border-bottom', 'border-center-h', 'border-center-v', 'border-inner', 'border-left', 'border-none', 'border-outer', 'border-right', 'border-style', 'border-style-alt', 'border-top', 'bow-arrow', 'bowling-ball', 'bowling-pins', 'box', 'box-alt', 'box-ballot', 'box-check', 'box-fragile', 'box-full', 'box-heart', 'box-open', 'box-up', 'box-usd', 'boxes', 'boxes-alt', 'boxing-glove', 'brackets', 'brackets-curly', 'braille', 'brain', 'bread-loaf', 'bread-slice', 'briefcase', 'briefcase-medical', 'bring-forward', 'bring-front', 'broadcast-tower', 'broom', 'browser', 'brush', 'bug', 'building', 'bullhorn', 'bullseye', 'bullseye-arrow', 'bullseye-pointer', 'burger-soda', 'burn', 'burrito', 'bus', 'bus-alt', 'bus-school', 'business-time', 'cabinet-filing', 'cactus', 'calculator', 'calculator-alt', 'calendar', 'calendar-alt', 'calendar-check', 'calendar-day', 'calendar-edit', 'calendar-exclamation', 'calendar-minus', 'calendar-plus', 'calendar-star', 'calendar-times', 'calendar-week', 'camcorder', 'camera', 'camera-alt', 'camera-movie', 'camera-polaroid', 'camera-retro', 'campfire', 'campground', 'candle-holder', 'candy-cane', 'candy-corn', 'cannabis', 'capsules', 'car', 'car-alt', 'car-battery', 'car-building', 'car-bump', 'car-bus', 'car-crash', 'car-garage', 'car-mechanic', 'car-side', 'car-tilt', 'car-wash', 'caret-circle-down', 'caret-circle-left', 'caret-circle-right', 'caret-circle-up', 'caret-down', 'caret-left', 'caret-right', 'caret-square-down', 'caret-square-left', 'caret-square-right', 'caret-square-up', 'caret-up', 'carrot', 'cars', 'cart-arrow-down', 'cart-plus', 'cash-register', 'cassette-tape', 'cat', 'cauldron', 'cctv', 'certificate', 'chair', 'chair-office', 'chalkboard', 'chalkboard-teacher', 'charging-station', 'chart-area', 'chart-bar', 'chart-line', 'chart-line-down', 'chart-network', 'chart-pie', 'chart-pie-alt', 'chart-scatter', 'check', 'check-circle', 'check-double', 'check-square', 'cheese', 'cheese-swiss', 'cheeseburger', 'chess', 'chess-bishop', 'chess-bishop-alt', 'chess-board', 'chess-clock', 'chess-clock-alt', 'chess-king', 'chess-king-alt', 'chess-knight', 'chess-knight-alt', 'chess-pawn', 'chess-pawn-alt', 'chess-queen', 'chess-queen-alt', 'chess-rook', 'chess-rook-alt', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-double-down', 'chevron-double-left', 'chevron-double-right', 'chevron-double-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-square-down', 'chevron-square-left', 'chevron-square-right', 'chevron-square-up', 'chevron-up', 'child', 'chimney', 'church', 'circle', 'circle-notch', 'city', 'clarinet', 'claw-marks', 'clinic-medical', 'clipboard', 'clipboard-check', 'clipboard-list', 'clipboard-list-check', 'clipboard-prescription', 'clipboard-user', 'clock', 'clone', 'closed-captioning', 'cloud', 'cloud-download', 'cloud-download-alt', 'cloud-drizzle', 'cloud-hail', 'cloud-hail-mixed', 'cloud-meatball', 'cloud-moon', 'cloud-moon-rain', 'cloud-music', 'cloud-rain', 'cloud-rainbow', 'cloud-showers', 'cloud-showers-heavy', 'cloud-sleet', 'cloud-snow', 'cloud-sun', 'cloud-sun-rain', 'cloud-upload', 'cloud-upload-alt', 'clouds', 'clouds-moon', 'clouds-sun', 'club', 'cocktail', 'code', 'code-branch', 'code-commit', 'code-merge', 'coffee', 'coffee-togo', 'coffin', 'cog', 'cogs', 'coin', 'coins', 'columns', 'comment', 'comment-alt', 'comment-alt-check', 'comment-alt-dollar', 'comment-alt-dots', 'comment-alt-edit', 'comment-alt-exclamation', 'comment-alt-lines', 'comment-alt-medical', 'comment-alt-minus', 'comment-alt-music', 'comment-alt-plus', 'comment-alt-slash', 'comment-alt-smile', 'comment-alt-times', 'comment-check', 'comment-dollar', 'comment-dots', 'comment-edit', 'comment-exclamation', 'comment-lines', 'comment-medical', 'comment-minus', 'comment-music', 'comment-plus', 'comment-slash', 'comment-smile', 'comment-times', 'comments', 'comments-alt', 'comments-alt-dollar', 'comments-dollar', 'compact-disc', 'compass', 'compass-slash', 'compress', 'compress-alt', 'compress-arrows-alt', 'compress-wide', 'computer-classic', 'computer-speaker', 'concierge-bell', 'construction', 'container-storage', 'conveyor-belt', 'conveyor-belt-alt', 'cookie', 'cookie-bite', 'copy', 'copyright', 'corn', 'couch', 'cow', 'cowbell', 'cowbell-more', 'credit-card', 'credit-card-blank', 'credit-card-front', 'cricket', 'croissant', 'crop', 'crop-alt', 'cross', 'crosshairs', 'crow', 'crown', 'crutch', 'crutches', 'cube', 'cubes', 'curling', 'cut', 'dagger', 'database', 'deaf', 'debug', 'deer', 'deer-rudolph', 'democrat', 'desktop', 'desktop-alt', 'dewpoint', 'dharmachakra', 'diagnoses', 'diamond', 'dice', 'dice-d10', 'dice-d12', 'dice-d20', 'dice-d4', 'dice-d6', 'dice-d8', 'dice-five', 'dice-four', 'dice-one', 'dice-six', 'dice-three', 'dice-two', 'digging', 'digital-tachograph', 'diploma', 'directions', 'disc-drive', 'disease', 'divide', 'dizzy', 'dna', 'do-not-enter', 'dog', 'dog-leashed', 'dollar-sign', 'dolly', 'dolly-empty', 'dolly-flatbed', 'dolly-flatbed-alt', 'dolly-flatbed-empty', 'donate', 'door-closed', 'door-open', 'dot-circle', 'dove', 'download', 'drafting-compass', 'dragon', 'draw-circle', 'draw-polygon', 'draw-square', 'dreidel', 'drone', 'drone-alt', 'drum', 'drum-steelpan', 'drumstick', 'drumstick-bite', 'dryer', 'dryer-alt', 'duck', 'dumbbell', 'dumpster', 'dumpster-fire', 'dungeon', 'ear', 'ear-muffs', 'eclipse', 'eclipse-alt', 'edit', 'egg', 'egg-fried', 'eject', 'elephant', 'ellipsis-h', 'ellipsis-h-alt', 'ellipsis-v', 'ellipsis-v-alt', 'empty-set', 'engine-warning', 'envelope', 'envelope-open', 'envelope-open-dollar', 'envelope-open-text', 'envelope-square', 'equals', 'eraser', 'ethernet', 'euro-sign', 'exchange', 'exchange-alt', 'exclamation', 'exclamation-circle', 'exclamation-square', 'exclamation-triangle', 'expand', 'expand-alt', 'expand-arrows', 'expand-arrows-alt', 'expand-wide', 'external-link', 'external-link-alt', 'external-link-square', 'external-link-square-alt', 'eye', 'eye-dropper', 'eye-evil', 'eye-slash', 'fan', 'fan-table', 'farm', 'fast-backward', 'fast-forward', 'fax', 'feather', 'feather-alt', 'female', 'field-hockey', 'fighter-jet', 'file', 'file-alt', 'file-archive', 'file-audio', 'file-certificate', 'file-chart-line', 'file-chart-pie', 'file-check', 'file-code', 'file-contract', 'file-csv', 'file-download', 'file-edit', 'file-excel', 'file-exclamation', 'file-export', 'file-image', 'file-import', 'file-invoice', 'file-invoice-dollar', 'file-medical', 'file-medical-alt', 'file-minus', 'file-music', 'file-pdf', 'file-plus', 'file-powerpoint', 'file-prescription', 'file-search', 'file-signature', 'file-spreadsheet', 'file-times', 'file-upload', 'file-user', 'file-video', 'file-word', 'files-medical', 'fill', 'fill-drip', 'film', 'film-alt', 'film-canister', 'filter', 'fingerprint', 'fire', 'fire-alt', 'fire-extinguisher', 'fire-smoke', 'fireplace', 'first-aid', 'fish', 'fish-cooked', 'fist-raised', 'flag', 'flag-alt', 'flag-checkered', 'flag-usa', 'flame', 'flashlight', 'flask', 'flask-poison', 'flask-potion', 'flower', 'flower-daffodil', 'flower-tulip', 'flushed', 'flute', 'flux-capacitor', 'fog', 'folder',  'folder-minus', 'folder-open', 'folder-plus', 'folder-times', 'folder-tree', 'folders', 'font', 'font-case', 'football-ball', 'football-helmet', 'forklift', 'forward', 'fragile', 'french-fries', 'frog', 'frosty-head', 'frown', 'frown-open', 'function', 'funnel-dollar', 'futbol', 'game-board', 'game-board-alt', 'game-console-handheld', 'gamepad', 'gamepad-alt', 'gas-pump', 'gas-pump-slash', 'gavel', 'gem', 'genderless', 'ghost', 'gift', 'gift-card', 'gifts', 'gingerbread-man', 'glass', 'glass-champagne', 'glass-cheers', 'glass-citrus', 'glass-martini', 'glass-martini-alt', 'glass-whiskey', 'glass-whiskey-rocks', 'glasses', 'glasses-alt', 'globe', 'globe-africa', 'globe-americas', 'globe-asia', 'globe-europe', 'globe-snow', 'globe-stand', 'golf-ball', 'golf-club', 'gopuram', 'graduation-cap', 'gramophone', 'greater-than', 'greater-than-equal', 'grimace', 'grin', 'grin-alt', 'grin-beam', 'grin-beam-sweat', 'grin-hearts', 'grin-squint', 'grin-squint-tears', 'grin-stars', 'grin-tears', 'grin-tongue', 'grin-tongue-squint', 'grin-tongue-wink', 'grin-wink', 'grip-horizontal', 'grip-lines', 'grip-lines-vertical', 'grip-vertical', 'guitar', 'guitar-electric', 'guitars', 'h-square', 'h1', 'h2', 'h3', 'h4', 'hamburger', 'hammer', 'hammer-war', 'hamsa', 'hand-heart', 'hand-holding', 'hand-holding-box', 'hand-holding-heart', 'hand-holding-magic', 'hand-holding-seedling', 'hand-holding-usd', 'hand-holding-water', 'hand-lizard', 'hand-middle-finger', 'hand-paper', 'hand-peace', 'hand-point-down', 'hand-point-left', 'hand-point-right', 'hand-point-up', 'hand-pointer', 'hand-receiving', 'hand-rock', 'hand-scissors', 'hand-spock', 'hands', 'hands-heart', 'hands-helping', 'hands-usd', 'handshake', 'handshake-alt', 'hanukiah', 'hard-hat', 'hashtag', 'hat-chef', 'hat-cowboy', 'hat-cowboy-side', 'hat-santa', 'hat-winter', 'hat-witch', 'hat-wizard', 'hdd', 'head-side', 'head-side-brain', 'head-side-headphones', 'head-side-medical', 'head-vr', 'heading', 'headphones', 'headphones-alt', 'headset', 'heart', 'heart-broken', 'heart-circle', 'heart-rate', 'heart-square', 'heartbeat', 'helicopter', 'helmet-battle', 'hexagon', 'highlighter', 'hiking', 'hippo', 'history', 'hockey-mask', 'hockey-puck', 'hockey-sticks', 'holly-berry', 'home', 'home-alt', 'home-heart', 'home-lg', 'home-lg-alt', 'hood-cloak', 'horizontal-rule', 'horse', 'horse-head', 'horse-saddle', 'hospital', 'hospital-alt', 'hospital-symbol', 'hospital-user', 'hospitals', 'hot-tub', 'hotdog', 'hotel', 'hourglass', 'hourglass-end', 'hourglass-half', 'hourglass-start', 'house-damage', 'house-flood', 'hryvnia', 'humidity', 'hurricane', 'i-cursor', 'ice-cream', 'ice-skate', 'icicles', 'icons', 'icons-alt', 'id-badge', 'id-card', 'id-card-alt', 'igloo', 'image', 'image-polaroid', 'images', 'inbox', 'inbox-in', 'inbox-out', 'indent', 'industry', 'industry-alt', 'infinity', 'info', 'info-circle', 'info-square', 'inhaler', 'integral', 'intersection', 'inventory', 'island-tropical', 'italic', 'jack-o-lantern', 'jedi', 'joint', 'journal-whills', 'joystick', 'jug', 'kaaba', 'kazoo', 'kerning', 'key', 'key-skeleton', 'keyboard', 'keynote', 'khanda', 'kidneys', 'kiss', 'kiss-beam', 'kiss-wink-heart', 'kite', 'kiwi-bird', 'knife-kitchen', 'lambda', 'lamp', 'landmark', 'landmark-alt', 'language', 'laptop', 'laptop-code', 'laptop-medical', 'lasso', 'laugh', 'laugh-beam', 'laugh-squint', 'laugh-wink', 'layer-group', 'layer-minus', 'layer-plus', 'leaf', 'leaf-heart', 'leaf-maple', 'leaf-oak', 'lemon', 'less-than', 'less-than-equal', 'level-down', 'level-down-alt', 'level-up', 'level-up-alt', 'life-ring', 'lightbulb', 'lightbulb-dollar', 'lightbulb-exclamation', 'lightbulb-on', 'lightbulb-slash', 'lights-holiday', 'line-columns', 'line-height', 'link', 'lips', 'lira-sign', 'list', 'list-alt', 'list-music', 'list-ol', 'list-ul', 'location', 'location-arrow', 'location-circle', 'location-slash', 'lock', 'lock-alt', 'lock-open', 'lock-open-alt', 'long-arrow-alt-down', 'long-arrow-alt-left', 'long-arrow-alt-right', 'long-arrow-alt-up', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'loveseat', 'low-vision', 'luchador', 'luggage-cart', 'lungs', 'mace', 'magic', 'magnet', 'mail-bulk', 'mailbox', 'male', 'mandolin', 'map', 'map-marked', 'map-marked-alt', 'map-marker', 'map-marker-alt', 'map-marker-alt-slash', 'map-marker-check', 'map-marker-edit', 'map-marker-exclamation', 'map-marker-minus', 'map-marker-plus', 'map-marker-question', 'map-marker-slash', 'map-marker-smile', 'map-marker-times', 'map-pin', 'map-signs', 'marker', 'mars', 'mars-double', 'mars-stroke', 'mars-stroke-h', 'mars-stroke-v', 'mask', 'meat', 'medal', 'medkit', 'megaphone', 'meh', 'meh-blank', 'meh-rolling-eyes', 'memory', 'menorah', 'mercury', 'meteor', 'microchip', 'microphone', 'microphone-alt', 'microphone-alt-slash', 'microphone-slash', 'microphone-stand', 'microscope', 'mind-share', 'minus', 'minus-circle', 'minus-hexagon', 'minus-octagon', 'minus-square', 'mistletoe', 'mitten', 'mobile', 'mobile-alt', 'mobile-android', 'mobile-android-alt', 'money-bill', 'money-bill-alt', 'money-bill-wave', 'money-bill-wave-alt', 'money-check', 'money-check-alt', 'money-check-edit', 'money-check-edit-alt', 'monitor-heart-rate', 'monkey', 'monument', 'moon', 'moon-cloud', 'moon-stars', 'mortar-pestle', 'mosque', 'motorcycle', 'mountain', 'mountains', 'mouse', 'mouse-alt', 'mouse-pointer', 'mp3-player', 'mug', 'mug-hot', 'mug-marshmallows', 'mug-tea', 'music', 'music-alt', 'music-alt-slash', 'music-slash', 'narwhal', 'network-wired', 'neuter', 'newspaper', 'not-equal', 'notes-medical', 'object-group', 'object-ungroup', 'octagon', 'oil-can', 'oil-temp', 'om', 'omega', 'ornament', 'otter', 'outdent', 'overline', 'page-break', 'pager', 'paint-brush', 'paint-brush-alt', 'paint-roller', 'palette', 'pallet', 'pallet-alt', 'paper-plane', 'paperclip', 'parachute-box', 'paragraph', 'paragraph-rtl', 'parking', 'parking-circle', 'parking-circle-slash', 'parking-slash', 'passport', 'pastafarianism', 'paste', 'pause', 'pause-circle', 'paw', 'paw-alt', 'paw-claws', 'peace', 'pegasus', 'pen', 'pen-alt', 'pen-fancy', 'pen-nib', 'pen-square', 'pencil', 'pencil-alt', 'pencil-paintbrush', 'pencil-ruler', 'pennant', 'people-carry', 'pepper-hot', 'percent', 'percentage', 'person-booth', 'person-carry', 'person-dolly', 'person-dolly-empty', 'person-sign', 'phone', 'phone-alt', 'phone-laptop', 'phone-office', 'phone-plus', 'phone-rotary', 'phone-slash', 'phone-square', 'phone-square-alt', 'phone-volume', 'photo-video', 'pi', 'piano', 'piano-keyboard', 'pie', 'pig', 'piggy-bank', 'pills', 'pizza', 'pizza-slice', 'place-of-worship', 'plane', 'plane-alt', 'plane-arrival', 'plane-departure', 'play', 'play-circle', 'plug', 'plus', 'plus-circle', 'plus-hexagon', 'plus-octagon', 'plus-square', 'podcast', 'podium', 'podium-star', 'poll', 'poll-h', 'poll-people', 'poo', 'poo-storm', 'poop', 'popcorn', 'portrait', 'pound-sign', 'power-off', 'pray', 'praying-hands', 'prescription', 'prescription-bottle', 'prescription-bottle-alt', 'presentation', 'print', 'print-search', 'print-slash', 'procedures', 'project-diagram', 'projector', 'pumpkin', 'puzzle-piece', 'qrcode', 'question', 'question-circle', 'question-square', 'quidditch', 'quote-left', 'quote-right', 'quran', 'rabbit', 'rabbit-fast', 'racquet', 'radiation', 'radiation-alt', 'radio', 'radio-alt', 'rainbow', 'raindrops', 'ram', 'ramp-loading', 'random', 'receipt', 'record-vinyl', 'rectangle-landscape', 'rectangle-portrait', 'rectangle-wide', 'recycle', 'redo', 'redo-alt', 'registered', 'remove-format', 'repeat', 'repeat-1', 'repeat-1-alt', 'repeat-alt', 'reply', 'reply-all', 'republican', 'restroom', 'retweet', 'retweet-alt', 'ribbon', 'ring', 'rings-wedding', 'road', 'robot', 'rocket', 'route', 'route-highway', 'route-interstate', 'router', 'rss', 'rss-square', 'ruble-sign', 'ruler', 'ruler-combined', 'ruler-horizontal', 'ruler-triangle', 'ruler-vertical', 'running', 'rupee-sign', 'rv', 'sack', 'sack-dollar', 'sad-cry', 'sad-tear', 'salad', 'sandwich', 'satellite', 'satellite-dish', 'sausage', 'save', 'sax-hot', 'saxophone', 'scalpel', 'scalpel-path', 'scanner', 'scanner-image', 'scanner-keyboard', 'scanner-touchscreen', 'scarecrow', 'scarf', 'school', 'screwdriver', 'scroll', 'scroll-old', 'scrubber', 'scythe', 'sd-card', 'search', 'search-dollar', 'search-location', 'search-minus', 'search-plus', 'seedling', 'send-back', 'send-backward', 'sensor-smoke', 'server', 'shapes', 'share', 'share-all', 'share-alt', 'share-alt-square', 'share-square', 'sheep', 'shekel-sign', 'shield', 'shield-alt', 'shield-check', 'shield-cross', 'ship', 'shipping-fast', 'shipping-timed', 'shish-kebab', 'shoe-prints', 'shopping-bag', 'shopping-basket', 'shopping-cart', 'shovel', 'shovel-snow', 'shower', 'shredder', 'shuttle-van', 'shuttlecock', 'sickle', 'sigma', 'sign', 'sign-in', 'sign-in-alt', 'sign-language', 'sign-out', 'sign-out-alt', 'signal', 'signal-1', 'signal-2', 'signal-3', 'signal-4', 'signal-alt', 'signal-alt-1', 'signal-alt-2', 'signal-alt-3', 'signal-alt-slash', 'signal-slash', 'signal-stream', 'signature', 'sim-card', 'sitemap', 'skating', 'skeleton', 'ski-jump', 'ski-lift', 'skiing', 'skiing-nordic', 'skull', 'skull-cow', 'skull-crossbones', 'slash', 'sledding', 'sleigh', 'sliders-h', 'sliders-h-square', 'sliders-v', 'sliders-v-square', 'smile', 'smile-beam', 'smile-plus', 'smile-wink', 'smog', 'smoke', 'smoking', 'smoking-ban', 'sms', 'snake', 'snooze', 'snow-blowing', 'snowboarding', 'snowflake', 'snowflakes', 'snowman', 'snowmobile', 'snowplow', 'socks', 'solar-panel', 'sort', 'sort-alpha-down', 'sort-alpha-down-alt', 'sort-alpha-up', 'sort-alpha-up-alt', 'sort-alt', 'sort-amount-down', 'sort-amount-down-alt', 'sort-amount-up', 'sort-amount-up-alt', 'sort-down', 'sort-numeric-down', 'sort-numeric-down-alt', 'sort-numeric-up', 'sort-numeric-up-alt', 'sort-shapes-down', 'sort-shapes-down-alt', 'sort-shapes-up', 'sort-shapes-up-alt', 'sort-size-down', 'sort-size-down-alt', 'sort-size-up', 'sort-size-up-alt', 'sort-up', 'soup', 'spa', 'space-shuttle', 'space-station-moon', 'space-station-moon-alt', 'spade', 'sparkles', 'speaker', 'speakers', 'spell-check', 'spider', 'spider-black-widow', 'spider-web', 'spinner', 'spinner-third', 'splotch', 'spray-can', 'square', 'square-full', 'square-root', 'square-root-alt', 'squirrel', 'staff', 'stamp', 'star', 'star-and-crescent', 'star-christmas', 'star-exclamation', 'star-half', 'star-half-alt', 'star-of-david', 'star-of-life', 'stars', 'steak', 'steering-wheel', 'step-backward', 'step-forward', 'stethoscope', 'sticky-note', 'stocking', 'stomach', 'stop', 'stop-circle', 'stopwatch', 'store', 'store-alt', 'stream', 'street-view', 'stretcher', 'strikethrough', 'stroopwafel', 'subscript', 'subway', 'suitcase', 'suitcase-rolling', 'sun', 'sun-cloud', 'sun-dust', 'sun-haze', 'sunglasses', 'sunrise', 'sunset', 'superscript', 'surprise', 'swatchbook', 'swimmer', 'swimming-pool', 'sword', 'swords', 'synagogue', 'sync', 'sync-alt', 'syringe', 'table', 'table-tennis', 'tablet', 'tablet-alt', 'tablet-android', 'tablet-android-alt', 'tablet-rugged', 'tablets', 'tachometer', 'tachometer-alt', 'tachometer-alt-average', 'tachometer-alt-fast', 'tachometer-alt-fastest', 'tachometer-alt-slow', 'tachometer-alt-slowest', 'tachometer-average', 'tachometer-fast', 'tachometer-fastest', 'tachometer-slow', 'tachometer-slowest', 'taco', 'tag', 'tags', 'tally', 'tanakh', 'tape', 'tasks', 'tasks-alt', 'taxi', 'teeth', 'teeth-open', 'temperature-frigid', 'temperature-high', 'temperature-hot', 'temperature-low', 'tenge', 'tennis-ball', 'terminal', 'text', 'text-height', 'text-size', 'text-width', 'th', 'th-large', 'th-list', 'theater-masks', 'thermometer', 'thermometer-empty', 'thermometer-full', 'thermometer-half', 'thermometer-quarter', 'thermometer-three-quarters', 'theta', 'thumbs-down', 'thumbs-up', 'thumbtack', 'thunderstorm', 'thunderstorm-moon', 'thunderstorm-sun', 'ticket', 'ticket-alt', 'tilde', 'times', 'times-circle', 'times-hexagon', 'times-octagon', 'times-square', 'tint', 'tint-slash', 'tire', 'tire-flat', 'tire-pressure-warning', 'tire-rugged', 'tired', 'toggle-off', 'toggle-on', 'toilet', 'toilet-paper', 'toilet-paper-alt', 'tombstone', 'tombstone-alt', 'toolbox', 'tools', 'tooth', 'toothbrush', 'torah', 'torii-gate', 'tornado', 'tractor', 'trademark', 'traffic-cone', 'traffic-light', 'traffic-light-go', 'traffic-light-slow', 'traffic-light-stop', 'train', 'tram', 'transgender', 'transgender-alt', 'trash', 'trash-alt', 'trash-restore', 'trash-restore-alt', 'trash-undo', 'trash-undo-alt', 'treasure-chest', 'tree', 'tree-alt', 'tree-christmas', 'tree-decorated', 'tree-large', 'tree-palm', 'trees', 'triangle', 'triangle-music', 'trophy', 'trophy-alt', 'truck', 'truck-container', 'truck-couch', 'truck-loading', 'truck-monster', 'truck-moving', 'truck-pickup', 'truck-plow', 'truck-ramp', 'trumpet', 'tshirt', 'tty', 'turkey', 'turntable', 'turtle', 'tv', 'tv-alt', 'tv-music', 'tv-retro', 'typewriter', 'umbrella', 'umbrella-beach', 'underline', 'undo', 'undo-alt', 'unicorn', 'union', 'universal-access', 'university', 'unlink', 'unlock', 'unlock-alt', 'upload', 'usb-drive', 'usd-circle', 'usd-square', 'user', 'user-alt', 'user-alt-slash', 'user-astronaut', 'user-chart', 'user-check', 'user-circle', 'user-clock', 'user-cog', 'user-cowboy', 'user-crown', 'user-edit', 'user-friends', 'user-graduate', 'user-hard-hat', 'user-headset', 'user-injured', 'user-lock', 'user-md', 'user-md-chat', 'user-minus', 'user-music', 'user-ninja', 'user-nurse', 'user-plus', 'user-secret', 'user-shield', 'user-slash', 'user-tag', 'user-tie', 'user-times', 'users', 'users-class', 'users-cog', 'users-crown', 'users-medical', 'utensil-fork', 'utensil-knife', 'utensil-spoon', 'utensils', 'utensils-alt', 'value-absolute', 'vector-square', 'venus', 'venus-double', 'venus-mars', 'vhs', 'vial', 'vials', 'video', 'video-plus', 'video-slash', 'vihara', 'violin', 'voicemail', 'volcano', 'volleyball-ball', 'volume', 'volume-down', 'volume-mute', 'volume-off', 'volume-slash', 'volume-up', 'vote-nay', 'vote-yea', 'vr-cardboard', 'wagon-covered', 'walker', 'walkie-talkie', 'walking', 'wallet', 'wand', 'wand-magic', 'warehouse', 'warehouse-alt', 'washer', 'watch', 'watch-calculator', 'watch-fitness', 'water', 'water-lower', 'water-rise', 'wave-sine', 'wave-square', 'wave-triangle', 'waveform', 'waveform-path', 'webcam', 'webcam-slash', 'weight', 'weight-hanging', 'whale', 'wheat', 'wheelchair', 'whistle', 'wifi', 'wifi-1', 'wifi-2', 'wifi-slash', 'wind', 'wind-turbine', 'wind-warning', 'window', 'window-alt', 'window-close', 'window-maximize', 'window-minimize', 'window-restore', 'windsock', 'wine-bottle', 'wine-glass', 'wine-glass-alt', 'won-sign', 'wreath', 'wrench', 'x-ray', 'yen-sign', 'yin-yang'], 'fab': ['500px', 'accessible-icon', 'accusoft', 'acquisitions-incorporated', 'adn', 'adobe', 'adversal', 'affiliatetheme', 'airbnb', 'algolia', 'alipay', 'amazon', 'amazon-pay', 'amilia', 'android', 'angellist', 'angrycreative', 'angular', 'app-store', 'app-store-ios', 'apper', 'apple', 'apple-pay', 'artstation', 'asymmetrik', 'atlassian', 'audible', 'autoprefixer', 'avianex', 'aviato', 'aws', 'bandcamp', 'battle-net', 'behance', 'behance-square', 'bimobject', 'bitbucket', 'bitcoin', 'bity', 'black-tie', 'blackberry', 'blogger', 'blogger-b', 'bluetooth', 'bluetooth-b', 'bootstrap', 'btc', 'buffer', 'buromobelexperte', 'buy-n-large', 'buysellads', 'canadian-maple-leaf', 'cc-amazon-pay', 'cc-amex', 'cc-apple-pay', 'cc-diners-club', 'cc-discover', 'cc-jcb', 'cc-mastercard', 'cc-paypal', 'cc-stripe', 'cc-visa', 'centercode', 'centos', 'chrome', 'chromecast', 'cloudscale', 'cloudsmith', 'cloudversify', 'codepen', 'codiepie', 'confluence', 'connectdevelop', 'contao', 'cotton-bureau', 'cpanel', 'creative-commons', 'creative-commons-by', 'creative-commons-nc', 'creative-commons-nc-eu', 'creative-commons-nc-jp', 'creative-commons-nd', 'creative-commons-pd', 'creative-commons-pd-alt', 'creative-commons-remix', 'creative-commons-sa', 'creative-commons-sampling', 'creative-commons-sampling-plus', 'creative-commons-share', 'creative-commons-zero', 'critical-role', 'css3', 'css3-alt', 'cuttlefish', 'd-and-d', 'd-and-d-beyond', 'dailymotion', 'dashcube', 'delicious', 'deploydog', 'deskpro', 'dev', 'deviantart', 'dhl', 'diaspora', 'digg', 'digital-ocean', 'discord', 'discourse', 'dochub', 'docker', 'draft2digital', 'dribbble', 'dribbble-square', 'dropbox', 'drupal', 'dyalog', 'earlybirds', 'ebay', 'edge', 'elementor', 'ello', 'ember', 'empire', 'envira', 'erlang', 'ethereum', 'etsy', 'evernote', 'expeditedssl', 'facebook', 'facebook-f', 'facebook-messenger', 'facebook-square', 'fantasy-flight-games', 'fedex', 'fedora', 'figma', 'firefox', 'firefox-browser', 'first-order', 'first-order-alt', 'firstdraft', 'flickr', 'flipboard', 'fly', 'font-awesome', 'font-awesome-alt', 'font-awesome-flag', 'fonticons', 'fonticons-fi', 'fort-awesome', 'fort-awesome-alt', 'forumbee', 'foursquare', 'free-code-camp', 'freebsd', 'fulcrum', 'galactic-republic', 'galactic-senate', 'get-pocket', 'gg', 'gg-circle', 'git', 'git-alt', 'git-square', 'github', 'github-alt', 'github-square', 'gitkraken', 'gitlab', 'gitter', 'glide', 'glide-g', 'gofore', 'goodreads', 'goodreads-g', 'google', 'google-drive', 'google-play', 'google-plus', 'google-plus-g', 'google-plus-square', 'google-wallet', 'gratipay', 'grav', 'gripfire', 'grunt', 'gulp', 'hacker-news', 'hacker-news-square', 'hackerrank', 'hips', 'hire-a-helper', 'hooli', 'hornbill', 'hotjar', 'houzz', 'html5', 'hubspot', 'ideal', 'imdb', 'instagram', 'instagram-square', 'intercom', 'internet-explorer', 'invision', 'ioxhost', 'itch-io', 'itunes', 'itunes-note', 'java', 'jedi-order', 'jenkins', 'jira', 'joget', 'joomla', 'js', 'js-square', 'jsfiddle', 'kaggle', 'keybase', 'keycdn', 'kickstarter', 'kickstarter-k', 'korvue', 'laravel', 'lastfm', 'lastfm-square', 'leanpub', 'less', 'line', 'linkedin', 'linkedin-in', 'linode', 'linux', 'lyft', 'magento', 'mailchimp', 'mandalorian', 'markdown', 'mastodon', 'maxcdn', 'mdb', 'medapps', 'medium', 'medium-m', 'medrt', 'meetup', 'megaport', 'mendeley', 'microblog', 'microsoft', 'mix', 'mixcloud', 'mixer', 'mizuni', 'modx', 'monero', 'napster', 'neos', 'nimblr', 'node', 'node-js', 'npm', 'ns8', 'nutritionix', 'odnoklassniki', 'odnoklassniki-square', 'old-republic', 'opencart', 'openid', 'opera', 'optin-monster', 'orcid', 'osi', 'page4', 'pagelines', 'palfed', 'patreon', 'paypal', 'penny-arcade', 'periscope', 'phabricator', 'phoenix-framework', 'phoenix-squadron', 'php', 'pied-piper', 'pied-piper-alt', 'pied-piper-hat', 'pied-piper-pp', 'pied-piper-square', 'pinterest', 'pinterest-p', 'pinterest-square', 'playstation', 'product-hunt', 'pushed', 'python', 'qq', 'quinscape', 'quora', 'r-project', 'raspberry-pi', 'ravelry', 'react', 'reacteurope', 'readme', 'rebel', 'red-river', 'reddit', 'reddit-alien', 'reddit-square', 'redhat', 'renren', 'replyd', 'researchgate', 'resolving', 'rev', 'rocketchat', 'rockrms', 'safari', 'salesforce', 'sass', 'schlix', 'scribd', 'searchengin', 'sellcast', 'sellsy', 'servicestack', 'shirtsinbulk', 'shopify', 'shopware', 'simplybuilt', 'sistrix', 'sith', 'sketch', 'skyatlas', 'skype', 'slack', 'slack-hash', 'slideshare', 'snapchat', 'snapchat-ghost', 'snapchat-square', 'soundcloud', 'sourcetree', 'speakap', 'speaker-deck', 'spotify', 'squarespace', 'stack-exchange', 'stack-overflow', 'stackpath', 'staylinked', 'steam', 'steam-square', 'steam-symbol', 'sticker-mule', 'strava', 'stripe', 'stripe-s', 'studiovinari', 'stumbleupon', 'stumbleupon-circle', 'superpowers', 'supple', 'suse', 'swift', 'symfony', 'teamspeak', 'telegram', 'telegram-plane', 'tencent-weibo', 'the-red-yeti', 'themeco', 'themeisle', 'think-peaks', 'trade-federation', 'trello', 'tripadvisor', 'tumblr', 'tumblr-square', 'twitch', 'twitter', 'twitter-square', 'typo3', 'uber', 'ubuntu', 'uikit', 'umbraco', 'uniregistry', 'unity', 'untappd', 'ups', 'usb', 'usps', 'ussunnah', 'vaadin', 'viacoin', 'viadeo', 'viadeo-square', 'viber', 'vimeo', 'vimeo-square', 'vimeo-v', 'vine', 'vk', 'vnv', 'vuejs', 'waze', 'weebly', 'weibo', 'weixin', 'whatsapp', 'whatsapp-square', 'whmcs', 'wikipedia-w', 'windows', 'wix', 'wizards-of-the-coast', 'wolf-pack-battalion', 'wordpress', 'wordpress-simple', 'wpbeginner', 'wpexplorer', 'wpforms', 'wpressr', 'xbox', 'xing', 'xing-square', 'y-combinator', 'yahoo', 'yammer', 'yandex', 'yandex-international', 'yarn', 'yelp', 'yoast', 'youtube', 'youtube-square', 'zhihu', 'uca', 'uca-dos']};

    var icons_html = '';
    for (type_icons in icons) {
        for (var i = 0; i < icons[type_icons].length; i++) {
            var icon_name = icons[type_icons][i].replace('-', ' ');
            icons_html += '<div class="icon-item" style="height: 100px;width: 100px; float: left; text-align: center;" name_icon="' + icon_name + '" onclick="selectIcon(\'' + type_icons + " fa-" + icons[type_icons][i] + '\')"><i class="color-icon ' + type_icons + " fa-" + icons[type_icons][i] + ' fa-3x" style="margin-bottom: 6px;"></i><br>' + icon_name + '</div>';
        }
    }

    $(document).ready( function() {
        $('#modal-icon-icons').html(icons_html);
        var elements = $('#modal-icon-icons').children();
        $('.searchbox-input').on('keyup',function () {
            elements.show();
            var filter = $(this).val();
            if ( filter.trim() != '' ) {
                elements.not("[name_icon*='" + filter + "']").hide();
            }
            //$('#modal-icon-icons').find(".icon-item:not(:contains(" + $(this).val() + "))").css('display','none');
        });


        $(".eliminar-rutina").click(function(e) {
            Swal.fire({
                title: "¿Seguro desea eliminar esta rutina?",
                text: "Los clientes que tengan asociada esta rutina dejarán de estarlo.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar."
            }).then(function(result) {
                let boton_id = e.target.id;
                let rutina_id = boton_id.split("_").pop();
                console.log(rutina_id);
                if (result.value) {
                    $.ajax({
                      type: "POST",
                      url: '/rutina/eliminar/'+rutina_id,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    Swal.fire({
                      title: "Rutina eliminada.",
                      text: "La rutina se eliminó correctamente.",
                      icon: "success",
                      timer: 1500
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1600);

                }
            });
        });

    });

    function selectIcon(icon_id) {
        $('#icono_rutina').val(icon_id);
        toggleDivIconos();
        $('#icono_seleccionado').removeAttr('hidden');
        $('#icono_seleccionado').attr('class', icon_id+' fa-2x mr-5');
    }

    function toggleDivIconos() {
        let display = $('#div_iconos').css('display');
        if (display == 'none') {
            display = 'flex';
        } else {
            display = 'none';
        }
        $('#div_iconos').css('display', display);
    }

</script>

        <div class="card" style="overflow: scroll;">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto mr-auto d-flex mb-0 align-items-center">
                        <h3 class="mb-0">Rutinas</h3>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Crear</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(isset($rutinas))
                        @foreach ($rutinas as $rutina)
                            <div class="rutina col-md-4 mb-5" id="{{ $rutina->id }}" onclick="mostrarEjercicios({{ $rutina->id }})">
                                <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                                 <div class="card-body">
                                  <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <i class="{{ $rutina->icono }} fa-4x"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                            {{ $rutina->nombre }}
                                        </a>
                                        <div class="text-dark-75">
                                            ...
                                        </div>
                                        <div id="ejercicios_{{ $rutina->id }}" class="ejercicios" hidden="">
                                            <table class="table">
                                                <thead>
                                                    <th>Día</th>
                                                    <th>Nombre ejercicio</th>
                                                    <th>Cant. repeticiones</th>
                                                </thead>
                                                <tbody>
                                                    @foreach(json_decode($rutina->ejercicios) as $dia=>$ejercicios_dia)
                                                        <tr>
                                                            <td>{{ $dia }}</td>
                                                            <td>
                                                                @if(!empty($ejercicios_dia))
                                                                    @foreach($ejercicios_dia as $ej_rep)
                                                                        @foreach($ejercicios as $ej)
                                                                            @if($ej->id == $ej_rep->ejercicio_id)
                                                                                {{ $ej->nombre }}<br>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(!empty($ejercicios_dia))
                                                                    @foreach($ejercicios_dia as $ej_rep)
                                                                        {{ $ej_rep->repeticiones }}<br>
                                                                    @endforeach
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row" style="justify-content: space-evenly;">
                                            <button class="btn btn-outline-primary" style="margin-right: 20px" onclick="window.location='{{ route("rutina_detalle",$rutina->id) }}'">Editar</button>
                                            <button class="btn btn-outline-danger eliminar-rutina" id="eliminar_rutina_{{ $rutina->id }}">Eliminar</button>
                                        </div>
                                    </div>
                                  </div>
                                 </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>No hay rutinas cargadas</div>
                    @endif

                </div>
            </div>
        </div>

        {{-- modal añadir --}}
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form method="POST" action="{{ route('rutina_crear') }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            @csrf
                            <div class="row" style="justify-content: space-between;">
                                <h4 style="margin-left: 10px;">Crear rutina</h4>
                                <span class="btn btn-outline-primary" style="margin-right: 10px" data-target="#modal" data-toggle="modal">X</button>
                            </div>

                            <br />
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nombre" class="col-sm-2 col-form-label">Ícono</label>
                                <div class="col-sm-10 d-flex justify-content-end align-items-center">
                                    <i id="icono_seleccionado" hidden class=""></i>
                                    <a class="btn btn-info" onclick="toggleDivIconos()">Elegir ícono</a>
                                    <input type="text" hidden name="icono_rutina" id="icono_rutina">
                                </div>
                            </div>

                            <div id="div_iconos" style="display: none;">
                                <div class="modal-content">
                                    <div style="align-items: flex-end; margin-top: 10px; margin-right: 20px;">
                                        <button type="button" class="close" onclick="toggleDivIconos()">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="search" placeholder="Buscar..." name="search" class="form-control searchbox-input">
                                        <br>
                                        <div id="modal-icon-icons" style="height: 280px; overflow-y: scroll;">
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <h6>Ejercicios</h6>

                            <br />
                            <label>Dia 1:</label>
                            <div class="input-group control-group after-add-more" id="dia1">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia1" onclick="diaDescanso('dia1')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia1')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia1[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia1[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 2:</label>
                            <div class="input-group control-group after-add-more" id="dia2">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia2" onclick="diaDescanso('dia2')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia2')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia2[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia2[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 3:</label>
                            <div class="input-group control-group after-add-more" id="dia3">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia3" onclick="diaDescanso('dia3')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia3')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia3[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia3[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 4:</label>
                            <div class="input-group control-group after-add-more" id="dia4">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia4" onclick="diaDescanso('dia4')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia4')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia4[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia4[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 5:</label>
                            <div class="input-group control-group after-add-more" id="dia5">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia5" onclick="diaDescanso('dia5')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia5')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia5[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia5[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 6:</label>
                            <div class="input-group control-group after-add-more" id="dia6">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia6" onclick="diaDescanso('dia6')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia6')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia6[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia6[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <label>Dia 7:</label>
                            <div class="input-group control-group after-add-more" id="dia7">

                            </div>
                            <br />
                            <button class="btn btn-secondary mb-4" type="button" id="descansodia7" onclick="diaDescanso('dia7')"><i class="fas fa-moon"></i> Día de descanso</button>
                            <button class="btn btn-success mb-4 add-more" type="button" onclick="añadirEjercicio('dia7')"><i class="fas fa-plus"></i> Añadir ejercicio</button>

                            <div style="display: none;">
                                <div class="control-group input-group removable" style="margin-top:10px">
                                    <select class="form-control" name="ejercicios_dia7[]">
                                        <option value="" selected hidden>Seleccione un ejercicio</option>
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="repeticiones_dia7[]">

                                    <div class="input-group-btn">
                                      <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="crear_rutina">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="copy" style="visibility: hidden;">
          <div class="control-group input-group removable" style="margin-top:10px">
            <select class="form-control" name="ejercicios_[]">
                <option value="" selected hidden>Seleccione un ejercicio</option>
                @foreach($ejercicios as $ejercicio)
                    <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control" name="repeticiones_[]">

            <div class="input-group-btn">
              <button class="btn btn-danger remove" type="button" onclick="eliminarEjercicio(this)"><i class="far fa-trash-alt"></i> Eliminar</button>
            </div>
          </div>
        </div>


    <input type="text" hidden name="rutina_seleccionada" id="rutina_seleccionada">

@endsection