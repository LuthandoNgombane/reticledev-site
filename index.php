<?php
// Initialize variables for popup messages
$alertMessage = '';
$alertType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Name'], $_POST['Email'], $_POST['Subject'], $_POST['Message'])) {
    // Sanitize and validate inputs
    $name = trim(filter_var($_POST['Name'] ?? '', FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['Email'] ?? '', FILTER_SANITIZE_EMAIL));
    $subject = trim(filter_var($_POST['Subject'] ?? '', FILTER_SANITIZE_STRING));
    $message = trim(filter_var($_POST['Message'] ?? '', FILTER_SANITIZE_STRING));

    // Server-side validation
    $errors = [];
    if (empty($name) || strlen($name) < 2) {
        $errors[] = 'Name is required and must be at least 2 characters.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }
    if (empty($subject) || strlen($subject) < 3) {
        $errors[] = 'Subject is required and must be at least 3 characters.';
    }
    if (empty($message) || strlen($message) < 10) {
        $errors[] = 'Message is required and must be at least 10 characters.';
    }

    if (empty($errors)) {
        // Store in MySQL database
        try {
            // require 'includes/db-config.php';
            // $stmt = $pdo->prepare("
            //     INSERT INTO contact_submissions (name, email, subject, message, submitted_at)
            //     VALUES (:name, :email, :subject, :message, NOW())
            // ");
            // $stmt->execute([
            //     'name' => $name,
            //     'email' => $email,
            //     'subject' => $subject,
            //     'message' => $message
            // ]);

            // Send email
            include 'sendmail.php';
            $alertMessage = "Your message has been sent successfully!";
            $alertType = 'success';
        } catch (PDOException $e) {
            $alertMessage = "Database error: " . $e->getMessage();
            $alertType = 'error';
        }
    } else {
        $alertMessage = implode('<br>', $errors);
        $alertType = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reticle Development - CIPC, Web & Mobile Development, SEO, Marketing & Graphic Design</title>
    <meta name="description" content="Reticle Development provides expert CIPC company registrations, custom web and mobile app development, SEO, digital marketing, and graphic design services including logos, letterheads, business profiles, and corporate designs in South Africa. Contact Reticle Dev in Pretoria today!">
    <meta name="keywords" content="Reticle Development, Reticle Dev, CIPC, CIPC registration South Africa, company registrations, business registration South Africa, web development, custom web development, mobile development, mobile app development, software development, SEO, SEO services Pretoria, social media marketing, digital marketing, graphic design, logos, letterheads, business profiles, corporate designs, Pretoria, Gauteng, South Africa">
    <meta name="author" content="Reticle Development">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="ZA">
    <meta name="geo.placename" content="South Africa">
    <meta name="geo.position" content="-26.2041;28.0473">
    <meta name="ICBM" content="-26.2041, 28.0473">
    <link rel="canonical" href="https://www.reticledev.co.za/">
    <link rel="sitemap" href="/sitemap.xml">
    <link rel="icon" type="image/x-icon" href="images/reticle-dev.jpg">
    <!-- Open Graph Tags -->
    <meta property="og:title" content="Reticle Development - CIPC, Web & Mobile Development, SEO, Marketing & Graphic Design in South Africa">
    <meta property="og:description" content="Reticle Dev offers expert CIPC company registrations, custom web and mobile app development, SEO, digital marketing, and graphic design services in Pretoria, South Africa. Grow your business with Reticle Development today!">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.reticledev.co.za/">
    <meta property="og:image" content="https://www.reticledev.co.za/images/max_logo.jpg">
    <meta property="og:image:alt" content="Reticle Development Logo">
    <meta property="og:site_name" content="Reticle Development">
    <meta property="og:locale" content="en_ZA">
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Reticle Dev - CIPC, Web Development, SEO, Marketing & Graphic Design">
    <meta name="twitter:description" content="Transform your business with Reticle Development's CIPC registration, custom web and mobile development, SEO, digital marketing, and graphic design services in Pretoria, South Africa.">
    <meta name="twitter:image" content="https://www.reticledev.co.za/images/max_logo.jpg">
    <meta name="twitter:image:alt" content="Reticle Development Logo">
    <meta name="twitter:site" content="@ReticleDev">
    <!-- CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Reticle Development",
        "alternateName": "Reticle Dev",
        "url": "https://www.reticledev.co.za",
        "logo": "https://www.reticledev.co.za/images/max_logo.jpg",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+27684683883",
            "contactType": "Customer Service",
            "areaServed": "ZA",
            "availableLanguage": "English"
        },
        "sameAs": [
            "https://www.facebook.com/reticledev",
            "https://www.linkedin.com/company/reticledev",
            "https://wa.me/+27684683883"
        ],
        "description": "Reticle Development provides CIPC company registrations, custom web development, mobile app development, SEO, digital marketing, and graphic design services including logos, letterheads, business profiles, and corporate designs in South Africa."
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Reticle Development",
        "alternateName": "Reticle Dev",
        "url": "https://www.reticledev.co.za",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.reticledev.co.za/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Reticle Development",
        "alternateName": "Reticle Dev",
        "image": "https://www.reticledev.co.za/images/max_logo.jpg",
        "telephone": "+27684683883",
        "email": "enquiries@reticledev.co.za",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Pretoria",
            "addressRegion": "Gauteng",
            "addressCountry": "ZA"
        },
        "url": "https://www.reticledev.co.za",
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
            ],
            "opens": "09:00",
            "closes": "17:00"
        },
        "offers": [
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "CIPC Company Registrations",
                    "description": "Expert CIPC company registration and business registration services in South Africa."
                },
                "priceCurrency": "ZAR",
                "price": "751.50"
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Web Development",
                    "description": "Custom web development and software development services in Pretoria, South Africa."
                },
                "priceCurrency": "ZAR",
                "price": "251.50",
                "priceSpecification": {
                    "@type": "PriceSpecification",
                    "price": "251.50",
                    "priceCurrency": "ZAR",
                    "description": "Starting from R251.50 per month"
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "SEO and Digital Marketing",
                    "description": "SEO services and social media marketing in Pretoria, South Africa."
                },
                "priceCurrency": "ZAR",
                "price": "100.00",
                "priceSpecification": {
                    "@type": "PriceSpecification",
                    "price": "100.00",
                    "priceCurrency": "ZAR",
                    "description": "Starting from R100.00 per day"
                }
            },
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "Graphic Design",
                    "description": "Professional graphic design services including logos, letterheads, business profiles, and corporate designs in South Africa."
                },
                "priceCurrency": "ZAR",
                "price": "500.00",
                "priceSpecification": {
                    "@type": "PriceSpecification",
                    "price": "500.00",
                    "priceCurrency": "ZAR",
                    "description": "Starting from R500.00 per project"
                }
            }
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "What is Reticle Development?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Reticle Development, also known as Reticle Dev, is a South African company based in Pretoria, Gauteng, offering CIPC company registrations, custom web development, mobile app development, SEO, digital marketing, and graphic design services including logos, letterheads, business profiles, and corporate designs."
                }
            },
            {
                "@type": "Question",
                "name": "What services does Reticle Dev offer?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Reticle Dev provides expert CIPC company registration, business registration, custom web development, mobile app development, software development, SEO services, social media marketing, digital marketing, and graphic design services including logos, letterheads, business profiles, and corporate designs in Pretoria and throughout South Africa."
                }
            },
            {
                "@type": "Question",
                "name": "How much does CIPC registration cost with Reticle Development?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "CIPC company registration with Reticle Development costs R751.50 as a once-off fee, including all necessary documentation like the Memorandum of Incorporation (MOI) and Company Registration Certificate."
                }
            },
            {
                "@type": "Question",
                "name": "Does Reticle Dev offer web development services?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, Reticle Dev specializes in custom web development, mobile app development, and software development in South Africa, starting from R251.50 per month."
                }
            },
            {
                "@type": "Question",
                "name": "Can Reticle Development help with SEO and marketing?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Absolutely! Reticle Development offers SEO services, social media marketing, and digital marketing in Pretoria, South Africa, starting from R100.00 per day."
                }
            },
            {
                "@type": "Question",
                "name": "Does Reticle Dev provide graphic design services?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, Reticle Development offers professional graphic design services, including logos, letterheads, business profiles, and corporate designs, starting from R500.00 per project."
                }
            }
        ]
    }
    </script>
</head>
<body class="site-body">
<!-- Popup for success/error messages -->
<?php if ($alertMessage): ?>
<div class="alert-popup <?php echo $alertType === 'success' ? 'alert-success' : 'alert-error'; ?>" id="alertPopup" role="alert">
    <p><?php echo htmlspecialchars($alertMessage); ?></p>
    <button onclick="closePopup()" aria-label="Close alert">OK</button>
</div>
<script>
    document.getElementById('alertPopup').style.display = 'block';
</script>
<?php endif; ?>

<header class="w3-top">
    <nav class="w3-row w3-large w3-light-grey" aria-label="Main navigation">
        <div class="w3-col s3 m2 l2 w3-center">
            <a href="/" class="w3-button w3-block" title="Reticle Development Home Page">Home</a>
        </div>
        <div class="w3-col s3 m2 l2 w3-center">
            <a href="#plans" class="w3-button w3-block" title="CIPC, Web Development, Marketing, and Graphic Design Services">Try Us</a>
        </div>
        <div class="w3-col s3 m2 l2 w3-center">
            <a href="#about" class="w3-button w3-block" title="About Reticle Development Team">About</a>
        </div>
        <div class="w3-col s3 m2 l2 w3-center">
            <a href="#contact" class="w3-button w3-block" title="Contact Reticle Dev for CIPC, SEO, and Graphic Design Services">Contact</a>
        </div>
        <div class="w3-col s12 m4 l4 w3-center logo-container">
            <img src="images/max_logo.jpg" alt="Reticle Development Logo - CIPC, Web Development, and Graphic Design Services" loading="lazy">
        </div>
    </nav>
</header>

<main class="w3-content site-main">
    <section class="w3-container">
        <div class="w3-display-container mySlides slide-background">
            <img src="images/cipc-long-logo-resized.jpg" class="slideshow-image" alt="CIPC Company Registration Services in South Africa by Reticle Development" loading="lazy">
            <div class="w3-display-topleft w3-container w3-padding-32 w3-opacity-min w3-black">
                <div class="slide-text-container">
                    <span class="w3-text-light-grey w3-padding-large w3-animate-bottom">CIPC Company Registrations and Amendments in South Africa</span>
                </div>
            </div>
        </div>
        <div class="w3-display-container mySlides slide-background">
            <img src="images/software-development-bg-removed.jpg" class="slideshow-image" alt="Custom Web and Mobile App Development by Reticle Dev in Pretoria" loading="lazy">
            <div class="w3-display-topleft w3-container w3-padding-32 w3-opacity-min w3-black">
                <div class="slide-text-container">
                    <span class="w3-text-light-grey w3-padding-large w3-animate-bottom">Custom Web and Mobile App Development in South Africa</span>
                </div>
            </div>
        </div>
        <div class="w3-display-container mySlides slide-background">
            <img src="images/marketing-management-resized.jpg" class="slideshow-image" alt="SEO and Social Media Marketing Services in South Africa by Reticle Development" loading="lazy">
            <div class="w3-display-topleft w3-container w3-padding-32 w3-opacity-min w3-black">
                <div class="slide-text-container">
                    <span class="w3-text-light-grey w3-padding-large w3-animate-bottom">SEO and Digital Marketing Services in South Africa</span>
                </div>
            </div>
        </div>
        <div class="w3-display-container mySlides slide-background">
            <img src="images/graphic-design.jpg" class="slideshow-image" alt="Graphic Design Services including Logos, Letterheads, and Corporate Designs by Reticle Development" loading="lazy">
            <div class="w3-display-topleft w3-container w3-padding-32 w3-opacity-min w3-black">
                <div class="slide-text-container">
                    <span class="w3-text-light-grey w3-padding-large w3-animate-bottom">Professional Graphic Design Services in South Africa</span>
                </div>
            </div>
        </div>
        <div class="w3-container slideshow-controls">
            <div class="w3-center" role="navigation" aria-label="Slideshow controls">
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-black" onclick="currentDiv(1)" aria-label="Slide 1"></span>
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-black" onclick="currentDiv(2)" aria-label="Slide 2"></span>
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-black" onclick="currentDiv(3)" aria-label="Slide 3"></span>
                <span class="w3-tag demodots w3-border w3-transparent w3-hover-black" onclick="currentDiv(4)" aria-label="Slide 4"></span>
            </div>
        </div>
    </section>

    <section class="w3-center w3-padding-16">
        <h1 class="w3-xlarge w3-padding-16">What Reticle Development Does for Your Business</h1>
        <p>Reticle Development, also known as Reticle Dev, is your trusted partner in South Africa for CIPC company registrations, custom web development, mobile app development, SEO, digital marketing, and professional graphic design services.</p>
    </section>

   <section class="w3-row-padding services-section">
        <article class="w3-col l3 m6 service-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow service-card-content">
                <li class="w3-light-grey w3-large w3-padding-16">
                    <h2 class="service-title">CIPC Company Registrations</h2>
                </li>
                <li class="w3-padding-16">
                    <p class="service-description">Reticle Development offers expert CIPC services for new business registrations and amendments in South Africa, ensuring compliance.</p>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 service-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow service-card-content">
                <li class="w3-white w3-large w3-padding-16">
                    <h2 class="service-title">Web and Mobile Development</h2>
                </li>
                <li class="w3-padding-16">
                    <p class="service-description">Stand out with bespoke web and mobile app development by Reticle Dev, tailored to your business in South Africa.</p>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 service-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow service-card-content">
                <li class="w3-black w3-large w3-padding-16">
                    <h2 class="service-title">SEO and Digital Marketing</h2>
                </li>
                <li class="w3-padding-16">
                    <p class="service-description">Boost your online presence with Reticle Development’s SEO, social media, and digital marketing in Pretoria, South Africa.</p>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 service-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow service-card-content">
                <li class="w3-grey w3-large w3-padding-16">
                    <h2 class="service-title">Graphic Design Services</h2>
                </li>
                <li class="w3-padding-16">
                    <p class="service-description">Elevate your brand with graphic design services, including logos and corporate designs, by Reticle Dev in South Africa.</p>
                </li>
            </ul>
        </article>
    </section>

    <section class="w3-center w3-padding-64" id="plans">
        <h2>Explore Reticle Dev’s Services in South Africa</h2>
        <p>Click 'Learn More' to discover our CIPC registration, web development, marketing, and graphic design solutions.</p>
    </section>

    <section class="w3-row-padding pricing-section">
        <article class="w3-col l3 m6 pricing-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow custom-border pricing-card-content">
                <li class="w3-black w3-xlarge w3-padding-32">CIPC Company Registrations</li>
                <li class="w3-padding-16"><b>Memorandum of Incorporation (MOI)</b></li>
                <li class="w3-padding-16"><b>Notice of Incorporation (CoR 14.1)</b></li>
                <li class="w3-padding-16"><b>Company Registration Certificate (CoR 14.3)</b></li>
                <li class="w3-padding-16"><b>Share Certificates and Other Documents</b></li>
                <li class="w3-padding-16">
                    <h3 class="w3-wide">Only R 751.50</h3>
                    <span class="w3-opacity">Once Off</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="#contact" class="w3-button w3-green w3-padding-large" title="Learn More About CIPC Company Registration with Reticle Development">Learn More</a>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 pricing-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow custom-border pricing-card-content">
                <li class="w3-grey w3-xlarge w3-padding-32">Website Domain Setup & Hosting</li>
                <li class="w3-padding-16"><b>Domain Registration and Hosting</b></li>
                <li class="w3-padding-16"><b>Database Storage of Data</b></li>
                <li class="w3-padding-16"><b>Site Management and Maintenance</b></li>
                <li class="w3-padding-16"><b>Business Data Management and Reporting</b></li>
                <li class="w3-padding-16">
                    <h3 class="w3-wide">From R 251.50</h3>
                    <span class="w3-opacity">Per Month</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="#contact" class="w3-button w3-green w3-padding-large" title="Learn More About Web and Mobile Development with Reticle Dev">Learn More</a>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 pricing-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow custom-border pricing-card-content">
                <li class="w3-white w3-xlarge w3-padding-32">SEO and Digital Marketing</li>
                <li class="w3-padding-16"><b>Social Media Advert Design</b></li>
                <li class="w3-padding-16"><b>Social Media Advert Budgeting and Planning</b></li>
                <li class="w3-padding-16"><b>Social Media Campaign Runs</b></li>
                <li class="w3-padding-16"><b>Social Media Insights and Analysis</b></li>
                <li class="w3-padding-16">
                    <h3 class="w3-wide">From R 100.00</h3>
                    <span class="w3-opacity">Per Day</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="#contact" class="w3-button w3-green w3-padding-large" title="Learn More About SEO and Digital Marketing with Reticle Development">Learn More</a>
                </li>
            </ul>
        </article>
        <article class="w3-col l3 m6 pricing-card">
            <ul class="w3-ul w3-border w3-center w3-hover-shadow custom-border pricing-card-content">
                <li class="w3-dark-grey w3-xlarge w3-padding-32">Graphic Design</li>
                <li class="w3-padding-16"><b>Logo Design</b></li>
                <li class="w3-padding-16"><b>Letterheads</b></li>
                <li class="w3-padding-16"><b>Business Profiles</b></li>
                <li class="w3-padding-16"><b>Corporate Designs</b></li>
                <li class="w3-padding-16">
                    <h3 class="w3-wide">From R 500.00</h3>
                    <span class="w3-opacity">Per Project</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="#contact" class="w3-button w3-green w3-padding-large" title="Learn More About Graphic Design with Reticle Development">Learn More</a>
                </li>
            </ul>
        </article>
    </section>

    <section class="w3-center w3-padding-64" id="about">
        <h2>About the Reticle Development Team</h2>
        <p>Meet the experts behind Reticle Dev, delivering top-notch CIPC, web development, marketing, and graphic design services in South Africa.</p>
    </section>

    <section class="w3-row-padding team-section">
        <article class="w3-col l3 m6 team-card">
            <div class="w3-card-4 team-card-content">
                <div class="w3-ul w3-container">
                    <li class="w3padding-16"><h3 class="team-name">Luthando Ngombane</h3></li>
                    <li class="w3padding-16"><p class="w3-opacity team-role">Project Manager and Solutions Architect</p></li>
                    <li class="w3padding-16"><p>From hardware to software, Luthando ensures Reticle Development delivers exceptional web and mobile development services.</p></li>
                </div>
            </div>
        </article>
        <article class="w3-col l3 m6 team-card">
            <div class="w3-card-4 team-card-content">
                <div class="w3-ul w3-container">
                    <li class="w3padding-16"><h3 class="team-name">Jarache Khunyeli</h3></li>
                    <li class="w3padding-16"><p class="w3-opacity team-role">Director and Software Engineer</p></li>
                    <li class="w3padding-16"><p>Jarache excels in managing Reticle Dev’s software development lifecycle for web and mobile solutions.</p></li>
                </div>
            </div>
        </article>
        <article class="w3-col l3 m6 team-card">
            <div class="w3-card-4 team-card-content">
                <div class="w3-ul w3-container">
                    <li class="w3padding-16"><h3 class="team-name">Candida Lima</h3></li>
                    <li class="w3padding-16"><p class="w3-opacity team-role">CIPC Specialist and Social Media Marketer</p></li>
                    <li class="w3padding-16"><p>Candida ensures CIPC compliance and boosts brand awareness through Reticle Development’s social media marketing.</p></li>
                </div>
            </div>
        </article>
        <article class="w3-col l3 m6 team-card">
            <div class="w3-card-4 team-card-content">
                <div class="w3-ul w3-container">
                    <li class="w3padding-16"><h3 class="team-name">Sibu Kaola</h3></li>
                    <li class="w3padding-16"><p class="w3-opacity team-role">Director and Sales Manager</p></li>
                    <li class="w3padding-16"><p>Sibu works closely with clients to deliver exceptional CIPC, SEO, and graphic design services with Reticle Dev.</p></li>
                </div>
            </div>
        </article>
    </section>

    <section class="w3-center w3-padding-64" id="contact">
        <h2>Contact Reticle Development for CIPC, Web Development, SEO, and Graphic Design Services</h2>
        <p>Get in touch with us for expert company registration, web development, digital marketing, and graphic design solutions in South Africa.</p>
    </section>

    <noscript>
        <p class="noscript-message">Please enable JavaScript for real-time form validation. You can still submit the form, and it will be validated on the server.</p>
    </noscript>

    <form class="w3-container" action="/" method="POST" aria-label="Contact Form">
        <div class="w3-section">
            <label for="name">Name</label>
            <input class="w3-input w3-border w3-hover-border-black form-input" type="text" id="name" name="Name" required>
            <span class="error-message" id="name-error"></span>
        </div>
        <div class="w3-section">
            <label for="email">Email</label>
            <input class="w3-input w3-border w3-hover-border-black form-input" type="email" id="email" name="Email" required>
            <span class="error-message" id="email-error"></span>
        </div>
        <div class="w3-section">
            <label for="subject">Subject</label>
            <input class="w3-input w3-border w3-hover-border-black form-input" id="subject" name="Subject" required>
            <span class="error-message" id="subject-error"></span>
        </div>
        <div class="w3-section">
            <label for="message">Message</label>
            <textarea class="w3-input w3-border w3-hover-border-black form-textarea" id="message" name="Message" rows="4" required></textarea>
            <span class="error-message" id="message-error"></span>
        </div>
        <button type="submit" class="w3-button w3-block w3-black" id="submit-btn" title="Send Message to Reticle Development">Send</button>
    </form>
</main>

<footer class="w3-container w3-padding-32 w3-light-grey w3-center" role="contentinfo">
    <a href="#" class="w3-button w3-black w3-margin" title="Back to Top"><i class="fa fa-arrow-up w3-margin-right"></i>To the Top</a>
    <div class="w3-xlarge w3-section" role="navigation" aria-label="Social media links">
        <a href="https://www.facebook.com/reticledev" target="_blank" rel="noopener noreferrer" aria-label="Visit Reticle Development on Facebook" title="Reticle Dev Facebook">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
        </a>
        <a href="https://www.linkedin.com/company/reticledev" target="_blank" rel="noopener noreferrer" aria-label="Visit Reticle Development on LinkedIn" title="Reticle Dev LinkedIn">
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </a>
        <a href="https://wa.me/+27684683883" target="_blank" rel="noopener noreferrer" aria-label="Contact Reticle Dev on WhatsApp" title="Reticle Development WhatsApp">
            <i class="fa fa-whatsapp w3-hover-opacity"></i>
        </a>
    </div>
    <p>© <?php echo date("Y"); ?> Reticle Development. All rights reserved.</p>
    <p><a href="/orders/accountLogin" title="Order CIPC, Web Development, SEO, or Graphic Design Services">Order CIPC, Web Development, SEO, or Graphic Design Services</a> with Reticle Dev in Pretoria, South Africa.</p>
</footer>

<script src="scripts/functions.js"></script>
</body>
</html>