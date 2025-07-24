@php
    // Try to load custom maintenance data
    $customMaintenanceFile = storage_path('framework/maintenance_custom.json');
    $customData = [];
    if (file_exists($customMaintenanceFile)) {
        $customData = json_decode(file_get_contents($customMaintenanceFile), true) ?: [];
    }
    
    // Default values
    $maintenanceMessage = $customData['message'] ?? 'We\'re currently performing scheduled maintenance to improve your experience. Our team is working hard to get everything back online as soon as possible.';
    $contactInfo = $customData['contact'] ?? 'support@medquest.com';
    $estimatedTime = $customData['estimated'] ?? 'We\'ll be back shortly';
    $startTime = $customData['time'] ?? time();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance Mode - {{ config('app.name', 'Medquest') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/fave-icon_medquest.png') }}">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #022be2 0%, #0e86ff 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .maintenance-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 600px;
            width: 90%;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .medquest-logo {
            max-width: 280px;
            height: auto;
            margin-bottom: 2rem;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
        }
        
        .maintenance-icon {
            font-size: 4rem;
            color: #4F46E5;
            margin-bottom: 1.5rem;
            animation: bounce 2s infinite;
        }
        
        .maintenance-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .maintenance-message {
            font-size: 1.125rem;
            color: #6B7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .contact-info {
            background: #F3F4F6;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        .contact-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }
        
        .contact-details {
            color: #6B7280;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .contact-details a {
            color: #4F46E5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .contact-details a:hover {
            color: #3730A3;
        }
        
        .progress-bar {
            background: #E5E7EB;
            border-radius: 10px;
            height: 8px;
            margin: 2rem 0;
            overflow: hidden;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #4F46E5, #7C3AED);
            height: 100%;
            width: 0%;
            border-radius: 10px;
            animation: progress 3s ease-in-out infinite;
        }
        
        .footer-text {
            font-size: 0.875rem;
            color: #9CA3AF;
            margin-top: 2rem;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        @keyframes progress {
            0% {
                width: 0%;
            }
            50% {
                width: 75%;
            }
            100% {
                width: 0%;
            }
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .maintenance-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .maintenance-title {
                font-size: 2rem;
            }
            
            .medquest-logo {
                max-width: 220px;
            }
            
            .maintenance-icon {
                font-size: 3rem;
            }
        }
        
        @media (max-width: 480px) {
            .maintenance-container {
                padding: 1.5rem;
            }
            
            .maintenance-title {
                font-size: 1.75rem;
            }
            
            .medquest-logo {
                max-width: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <!-- Medquest Logo -->
        <img src="{{ asset('images/logo/LOGO-MEDQUEST-HD-2020-11-27-14_56_44.png') }}" 
            alt="Medquest Logo" 
            class="medquest-logo">
        
        <!-- Maintenance Icon -->
        <div class="maintenance-icon">
            🔧
        </div>
        
        <!-- Main Title -->
        <h1 class="maintenance-title">
            System Under Maintenance
        </h1>
        
        <!-- Message -->
        <p class="maintenance-message">
            {{ $maintenanceMessage }}
        </p>
        
        <!-- Footer -->
        <p class="footer-text">
            Thank you for your patience. We'll be back shortly!<br>
            <strong>- ITD Medquest</strong>
        </p>
    </div>

    <script>
        // Auto-refresh the page every 5 minutes to check if maintenance is over
        setTimeout(function() {
            location.reload();
        }, 300000); // 5 minutes in milliseconds
        
        // Display current time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleString();
            console.log('Last checked at:', timeString);
        }
        
        updateTime();
        setInterval(updateTime, 60000); // Update every minute
    </script>
</body>
</html>
