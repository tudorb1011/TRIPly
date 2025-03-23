<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tudor & Miruna's Web Application</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    header {
        z-index: 999;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 200px;
        transition: 0.5s ease;
    }

    header .brand {
        color: #fff;
        font-size: 1.5em;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
    }

    header .navigation {
        position: relative;
    }

    header .navigation .navigation-items a {
        position: relative;
        color: #fff;
        font-size: 1em;
        font-weight: 500;
        text-decoration: none;
        margin-left: 30px;
        transition: 0.3s ease;
    }

    header .navigation .navigation-items a:before {
        content: '';
        position: absolute;
        background: #fff;
        width: 0;
        height: 3px;
        bottom: 0;
        left: 0;
        transition: 0.3s ease;
    }

    header .navigation .navigation-items a:hover:before {
        width: 100%;
    }

    section {
        padding: 100px 200px;
    }

    .home {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: #2696E9;
    }

    .home:before {
        z-index: 777;
        content: '';
        position: absolute;
        background: rgba(3, 96, 251, 0.3);
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .home .content {
        z-index: 888;
        color: #fff;
        width: 70%;
        margin-top: 50px;
        display: none;
    }

    .home .content.active {
        display: block;
    }

    .home .content h1 {
        font-size: 4em;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 5px;
        line-height: 75px;
        margin-bottom: 40px;
    }

    .home .content h1 span {
        font-size: 1.2em;
        font-weight: 600;
    }

    .home .content p {
        margin-bottom: 65px;
    }

    .home video {
        z-index: 000;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-navigation {
        z-index: 888;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translateY(80px);
        margin-bottom: 12px;
    }

    .slider-navigation .nav-btn {
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 0 2px rgba(255, 255, 255, 0.5);
        transition: 0.3s ease;
    }

    .slider-navigation .nav-btn.active {
        background: #2696E9;
    }

    .slider-navigation .nav-btn:not(:last-child) {
        margin-right: 20px;
    }

    .slider-navigation .nav-btn:hover {
        transform: scale(1.2);
    }

    .video-slide {
        position: absolute;
        width: 100%;
        clip-path: circle(0% at 0 50%);
    }

    .video-slide.active {
        clip-path: circle(150% at 0 50%);
        transition: 2s ease;
        transition-property: clip-path;
    }

    @media (max-width: 1040px) {
        header {
            padding: 12px 20px;
        }

        section {
            padding: 100px 20px;
        }

        .home .media-icons {
            right: 15px;
        }

        header .navigation {
            display: none;
        }

        header .navigation.active {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(1, 1, 1, 0.5);
        }

        header .navigation .navigation-items a {
            color: #222;
            font-size: 1.2em;
            margin: 20px;
        }

        header .navigation .navigation-items a:before {
            background: #222;
            height: 5px;
        }

        header .navigation.active .navigation-items {
            background: #fff;
            width: 600px;
            max-width: 600px;
            margin: 20px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 5px;
            box-shadow: 0 5px 25px rgb(1 1 1 / 20%);
        }

    }

    @media (max-width: 560px) {
        .home .content h1 {
            font-size: 3em;
            line-height: 60px;
        }
    }
</style>

<body>

    <header>
        <a href="#" class="brand">TRIPly</a>
        <div class="menu-btn"></div>
        <div class="navigation">
            <div class="navigation-items">
                <a href="index.php">Home</a>
                <a href="login.php">Log In</a>
                <a href="registration.php">Sign Up</a>
            </div>
        </div>
    </header>

    <section class="home">
        <video class="video-slide active" src="1.mp4" autoplay muted loop></video>
        <video class="video-slide" src="2.mp4" autoplay muted loop></video>
        <video class="video-slide" src="3.mp4" autoplay muted loop></video>
        <video class="video-slide" src="4.mp4" autoplay muted loop></video>
        <video class="video-slide" src="6.mp4" autoplay muted loop></video>
        <div class="content active">
            <h1>TRIPly.<br><span>PLAN YOUR DREAM TRIP</span></h1>
            <p>Welcome to TRIPly, your ultimate destination for planning your dream trip! Whether you're an avid
                traveler or
                someone looking to embark on a memorable adventure, TRIPly is here to simplify and enhance your trip
                planning
                experience.</p>
        </div>
        <div class="content">
            <h1>Too simple.<br><span>Too perfect</span></h1>
            <p>At TRIPly, we understand that every trip is unique and personal. Our goal is to provide you with a
                user-friendly platform that empowers you to create a customized itinerary tailored to your preferences
                and
                interests. From flights to accommodation, transportation to sightseeing, we've got you covered.</p>
        </div>
        <div class="content">
            <h1>Organized.<br><span>Off Road</span></h1>
            <p>With TRIPly, you have access to a comprehensive range of features and tools that cover every aspect of
                your trip planning.
                From selecting the perfect flights to finding the ideal accommodations, organizing transportation, and
                discovering exciting
                sightseeing options, we've got you covered. Our intuitive interface ensures a seamless and hassle-free
                experience, allowing
                you to focus on the excitement of your upcoming adventure.</p>
        </div>
        <div class="content">
            <h1>Ready? Set<br><span>Travel!</span></h1>
            <p>So, are you ready to plan your dream trip? Join us at TRIPly and unlock a world of possibilities. Whether
                it's an adventurous road trip, a relaxing beach getaway, or an off-the-beaten-path expedition, TRIPly is
                your trusted companion on your quest for extraordinary travel experiences.

                Get started today and let TRIPly be your guide as you embark on a journey of a lifetime. Plan, explore,
                connect, and create memories that will last a lifetime with TRIPly. Happy travels!</p>
        </div>
        <div class="content">
            <h1>Need help?<br><span>Meet Our Support Team: Tudor & Miruna</span></h1>
            <p>At TRIPly, we understand that sometimes you may need assistance or have questions during your
                trip-planning process. That's why we have a dedicated support team ready to provide you with the
                guidance and help you need.
                Tudor: tudor@contact.triply; +31671243501
                Miruna: miruna@contact.triply; +31671243502</p>
        </div>
        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>

    <script type="text/javascript">

        //Javacript for video slider navigation
        const btns = document.querySelectorAll(".nav-btn");
        const slides = document.querySelectorAll(".video-slide");
        const contents = document.querySelectorAll(".content");

        var sliderNav = function (manual) {
            btns.forEach((btn) => {
                btn.classList.remove("active");
            });

            slides.forEach((slide) => {
                slide.classList.remove("active");
            });

            contents.forEach((content) => {
                content.classList.remove("active");
            });

            btns[manual].classList.add("active");
            slides[manual].classList.add("active");
            contents[manual].classList.add("active");
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                sliderNav(i);
            });
        });
    </script>

</body>

</html>