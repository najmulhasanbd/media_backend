<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\CastingCall;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\HeroSlider;
use App\Models\Notice;
use App\Models\Review;
use App\Models\Setting;
use App\Models\ShootingHouse;
use App\Models\Talent;
use App\Models\Video;
use Illuminate\Database\Seeder;

class MediaCmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $catActor = Category::updateOrCreate(['slug' => 'actor'], ['name' => 'অভিনেতা', 'type' => 'talent']);
        $catActress = Category::updateOrCreate(['slug' => 'actress'], ['name' => 'অভিনেত্রী', 'type' => 'talent']);
        $catModel = Category::updateOrCreate(['slug' => 'model'], ['name' => 'মডেল', 'type' => 'talent']);
        $catChild = Category::updateOrCreate(['slug' => 'child-artist'], ['name' => 'শিশুশিল্পী', 'type' => 'talent']);
        $catForeign = Category::updateOrCreate(['slug' => 'international'], ['name' => 'বিদেশি শিল্পী', 'type' => 'talent']);

        // 2. Hero Sliders
        HeroSlider::truncate();
        HeroSlider::create([
            'badge' => '★ অফিসিয়াল কাস্টিং ও মিডিয়া পোর্টাল',
            'title' => 'মিডিয়া, প্রোডাকশন ও কাস্টিং পোর্টফোলিও',
            'subtitle' => 'আমরা নাটক, সিনেমা, ওটিটি সিরিজ এবং বিজ্ঞাপনের জন্য সঠিক ট্যালেন্ট ও পূর্ণাঙ্গ প্রোডাকশন সেবা প্রদান করি।',
            'image' => 'frontend/assets/images/hero-cinema.jpg',
            'btn_text_1' => 'প্রোফাইল জমা দিন',
            'btn_url_1' => '#registration-section',
            'btn_text_2' => 'শো-রিল',
            'btn_url_2' => '#openShowreelBtn',
            'order' => 1,
            'status' => true,
        ]);

        HeroSlider::create([
            'badge' => '★ আধুনিক ক্যামেরা ও সাউন্ড স্টুডিও',
            'title' => 'পূর্ণাঙ্গ মিডিয়া ও শুটিং সমাধান',
            'subtitle' => '৪কে সিনেমাটোগ্রাফি, লাইভ রেকর্ডিং এবং প্রফেশনাল এডিটিং সুবিধা নিয়ে আমরা সদা প্রস্তুত।',
            'image' => 'frontend/assets/images/hero-studio.jpg',
            'btn_text_1' => 'আমাদের কাজ দেখুন',
            'btn_url_1' => '#portfolio-section',
            'btn_text_2' => 'যোগাযোগ',
            'btn_url_2' => '#registration-section',
            'order' => 2,
            'status' => true,
        ]);

        // 3. Talents
        Talent::truncate();
        Talent::create([
            'category_id' => $catActor->id,
            'name' => 'আরিফুর রহমান',
            'specialty' => 'রোমান্টিক ও ড্রামা লিড রোল',
            'gender' => 'পুরুষ',
            'age' => '28 বছর',
            'height' => "5' 10\"",
            'experience' => '৪ বছর',
            'photo' => 'frontend/assets/images/portfolio-casting.jpg',
            'bio' => 'নাটক ও ওটিটি মাধ্যমে অভিজ্ঞ লিড অ্যাক্টর। বহু জনপ্রিয় বিজ্ঞাপনে কাজ করার অভিজ্ঞতা রয়েছে।',
            'audition_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        Talent::create([
            'category_id' => $catActress->id,
            'name' => 'মেহজাবিন তানিশা',
            'specialty' => 'গ্ল্যামার ও সিরিয়াস ড্রামা রোল',
            'gender' => 'মহিলা',
            'age' => '24 বছর',
            'height' => "5' 5\"",
            'experience' => '৩ বছর',
            'photo' => 'frontend/assets/images/portfolio-film.jpg',
            'bio' => 'সিনেমা ও টিভি নাটকের পরিচিত মুখ। চমৎকার ডায়লগ ডেলিভারি ও এক্সপ্রেশন।',
            'audition_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        Talent::create([
            'category_id' => $catModel->id,
            'name' => 'ফারহান আহমেদ',
            'specialty' => 'কমার্শিয়াল ও র‍্যাম্প মডেল',
            'gender' => 'পুরুষ',
            'age' => '26 বছর',
            'height' => "6' 0\"",
            'experience' => '৫ বছর',
            'photo' => 'frontend/assets/images/portfolio-music.jpg',
            'bio' => 'শীর্ষস্থানীয় ফ্যাশন হাউস ও ব্র্যান্ডের মডেলিং ক্যাম্পেইনে সফল অংশগ্রহণ।',
            'audition_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        Talent::create([
            'category_id' => $catForeign->id,
            'name' => 'আনাস্তাসিয়া ইভানোভা',
            'specialty' => 'আন্তর্জাতিক ফ্যাশন ও টিভিসি মডেল',
            'is_international' => true,
            'gender' => 'মহিলা',
            'age' => '23 বছর',
            'height' => "5' 9\"",
            'experience' => '৪ বছর',
            'photo' => 'frontend/assets/images/portfolio-casting.jpg',
            'bio' => 'ইউরোপ ও এশিয়ার বিভিন্ন আন্তর্জাতিক বিজ্ঞাপন ক্যাম্পেইন ও রানওয়ে মডেল।',
            'audition_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        Talent::create([
            'category_id' => $catChild->id,
            'name' => 'জারিফ হাসান',
            'specialty' => 'শিশুশিল্পী (বিজ্ঞাপন ও নাটক)',
            'gender' => 'ছেলে',
            'age' => '9 বছর',
            'height' => "4' 2\"",
            'experience' => '২ বছর',
            'photo' => 'frontend/assets/images/portfolio-film.jpg',
            'bio' => 'স্বভাবসুলভ অভিনয় ও স্পষ্ট বাচনভঙ্গি। একাধিক মেগা ব্র্যান্ড বিজ্ঞাপনে প্রশংসিত।',
            'audition_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // 4. Casting Calls
        CastingCall::truncate();
        CastingCall::create([
            'title' => 'নতুন পূর্ণদৈর্ঘ্য সিনেমার জন্য প্রধান ও সহ-অভিনেত্রী অডিশন',
            'project_type' => 'সিনেমা',
            'roles' => 'প্রধান নায়িকা ও বোন চরিত্র',
            'requirements' => 'বয়স ১৮-২৫ বছর, শুদ্ধ উচ্চারণ ও অভিনয়ে পারদর্শী হতে হবে।',
            'deadline' => '৩০ নভেম্বর ২০২৬',
            'location' => 'বনানী স্টুডিও, ঢাকা',
            'status' => 'open',
        ]);

        CastingCall::create([
            'title' => 'মাল্টিন্যাশনাল ব্র্যান্ড টিভিসি-র জন্য স্মার্ট পুরুষ মডেল প্রয়োজন',
            'project_type' => 'টিভিসি',
            'roles' => 'কর্পোরেট এক্সিকিউটিভ',
            'requirements' => 'উচ্চতা ৫\' ১০"+, সুঠাম দেহ ও কনফিডেন্ট পার্সোনালিটি।',
            'deadline' => '২৫ নভেম্বর ২০২৬',
            'location' => 'উত্তরা শুটিং জোন, ঢাকা',
            'status' => 'open',
        ]);

        CastingCall::create([
            'title' => 'ওটিটি থ্রিলার ওয়েব সিরিজের জন্য সাব-লিড ক্যারেক্টার অডিশন',
            'project_type' => 'ওটিটি',
            'roles' => 'পুলিশ অফিসার ও ভিলেন',
            'requirements' => 'বয়স ২৫-৩৫ বছর, অ্যাকশন ও তীব্র এক্সপ্রেশনে সাবলীল।',
            'deadline' => '১০ ডিসেম্বর ২০২৬',
            'location' => 'ধানমন্ডি, ঢাকা',
            'status' => 'open',
        ]);

        // 5. Videos
        Video::truncate();
        Video::create([
            'category' => 'cinema',
            'title' => 'আলো আঁধারের গল্প — অফিশিয়াল ট্রেলার',
            'director' => 'তানভীর আহমেদ',
            'client' => 'মাইন্ড ব্লোয়িং প্রোডাকশন',
            'duration' => '2:45 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'thumbnail' => 'frontend/assets/images/portfolio-film.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'drama',
            'title' => 'মেঘলা আকাশ — বিশেষ টেলিফিল্ম',
            'director' => 'রেদওয়ান রনি',
            'client' => 'গোল্ডেন ড্রামা',
            'duration' => '42:10 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'thumbnail' => 'frontend/assets/images/portfolio-music.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'tvc',
            'title' => 'প্রিমিয়াম ফ্যাশন ব্র্যান্ড ক্যাম্পেইন ২০২৬',
            'director' => 'অমিতাভ রেজা',
            'client' => 'স্টাইল ফ্যাশন বিডি',
            'duration' => '0:45 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'thumbnail' => 'frontend/assets/images/portfolio-casting.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        // 6. Shooting Houses
        ShootingHouse::truncate();
        ShootingHouse::create([
            'name' => 'পদ্মকুঁড়িয়া শুটিং প্যালেস',
            'location' => 'পূবাইল, গাজীপুর',
            'rent' => '৳ ২৫,০০০ / দিন',
            'contact' => '০১৭০০-১১২২৩৩',
            'facilities' => 'এসি ড্রেসিং রুম, জেনারেটর ব্যাকআপ, সুইমিং পুল, ডুপ্লেক্স হাউস',
            'image' => 'frontend/assets/images/hero-studio.jpg',
            'description' => 'নাটক, সিনেমা ও মিউজিক ভিডিও শুটিংয়ের জন্য মনোরম গ্রামীণ ও আধুনিক পরিবেশ।',
            'status' => true,
        ]);

        ShootingHouse::create([
            'name' => 'রাজমহল শুটিং ভিলা',
            'location' => 'কালিয়াকৈর, গাজীপুর',
            'rent' => '৳ ৩০,০০০ / দিন',
            'contact' => '০১৭০০-৪৪৫৫৬৬',
            'facilities' => 'ভিআইপি স্যুট, খোলা লন, কৃত্রিম লেক, আউটডোর গার্ডেন',
            'image' => 'frontend/assets/images/hero-cinema.jpg',
            'description' => 'বড় বাজেটের সিনেমা ও বিজ্ঞাপনের শুটিংয়ের জন্য রাজকীয় সেটআপ।',
            'status' => true,
        ]);

        // 7. Articles / Diaries / Opinions
        Article::truncate();
        Article::create([
            'type' => 'director',
            'title' => 'সিনেমাটোগ্রাফির নতুন দিগন্ত ও কাস্টিং বাস্তবতা',
            'slug' => 'cinematography-casting-reality',
            'author_name' => 'আশফাক নিপুণ',
            'author_role' => 'চলচ্চিত্র ও ড্রামা নির্মাতা',
            'content' => 'বর্তমান সময়ে ওটিটি এবং সিনেমার মূল শক্তি হলো নিখুঁত কাস্টিং। উপযুক্ত চরিত্রের সঠিক শিল্পী খুঁজে পাওয়া প্রোডাকশনের অর্ধেক কাজ সহজ করে দেয়।',
            'image' => 'frontend/assets/images/portfolio-film.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'artist',
            'title' => 'নতুন অভিনয়শিল্পীদের প্রস্তুতি ও আত্মবিশ্বাস গঠনের উপায়',
            'slug' => 'acting-preparation-confidence',
            'author_name' => 'আরিফিন শুভ',
            'author_role' => 'চলচ্চিত্র অভিনেতা',
            'content' => 'নিয়মিত থিয়েটার প্র্যাকটিস, কণ্ঠস্বরের ব্যায়াম ও ক্যামেরার সামনে সাবলীলতাই একজন অভিনয়শিল্পীকে তৈরি করে। ধৈর্যই এখানে সেরা মূলধন।',
            'image' => 'frontend/assets/images/portfolio-casting.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'opinion',
            'title' => 'বাংলাদেশের কনটেন্ট ইন্ডাস্ট্রিতে আধুনিক মিডিয়া পোর্টালের গুরুত্ব',
            'slug' => 'media-portal-importance',
            'author_name' => 'সম্পাদকীয় বিভাগ',
            'author_role' => 'মাইন্ড ব্লোয়িং মিডিয়া',
            'content' => 'ডিজিটাল যুগে ডিরেক্টরি এবং কেন্দ্রীভূত কাস্টিং প্ল্যাটফর্ম আমাদের নাট্য ও চলচ্চিত্র অঙ্গনকে আন্তর্জাতিক মানে নিয়ে যাচ্ছে।',
            'image' => 'frontend/assets/images/portfolio-music.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        // 8. Notices
        Notice::truncate();
        Notice::create([
            'title' => 'শীতকালীন মেগা অডিশন ২০২৬ এর সময়সূচি পরিবর্তন',
            'date' => '১২ নভেম্বর ২০২৬',
            'description' => 'অনিবার্য কারণবশত আগামী ১৫ নভেম্বরের বনানী অডিশন ক্যাম্প ১৭ নভেম্বর ২০২৬ তারিখে সকাল ১০টায় অনুষ্ঠিত হবে। সকলকে যথাসময়ে উপস্থিত থাকতে অনুরোধ করা হচ্ছে।',
            'is_pinned' => true,
            'status' => true,
        ]);

        Notice::create([
            'title' => 'ট্যালেন্ট প্রোফাইল ভেরিফিকেশন ড্রাইভ শুরু',
            'date' => '১ নভেম্বর ২০২৬',
            'description' => 'সকল রেজিস্টার্ড আর্টিস্ট ও মডেলদের তাদের পোর্টফোলিও এবং সাম্প্রতিক ছবি দিয়ে প্রোফাইল হালনাগাদ করার জন্য নির্দেশ দেওয়া হচ্ছে।',
            'is_pinned' => false,
            'status' => true,
        ]);

        // 9. Reviews
        Review::truncate();
        Review::create([
            'name' => 'মোস্তফা সারওয়ার ফারুকী',
            'designation' => 'চলচ্চিত্র ও ড্রামা নির্মাতা',
            'review' => 'মাইন্ড ব্লোয়িং মিডিয়া থেকে কাস্টিং নেওয়া ছিল আমাদের সাম্প্রতিক সিনেমা প্রজেক্টের সেরা সিদ্ধান্ত। এক ছাদের নিচে এত সমৃদ্ধ ট্যালেন্ট পাওয়া সত্যিই বিস্ময়কর।',
            'rating' => 5,
            'photo' => 'frontend/assets/images/portfolio-film.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        Review::create([
            'name' => 'নুসরাত ফারিয়া',
            'designation' => 'অভিনেত্রী ও মডেল',
            'review' => 'প্রফেশনাল মিডিয়া ও কাস্টিং প্ল্যাটফর্ম হিসেবে তাদের পরিবেশ ও ম্যানেজমেন্ট দারুণ। নতুন ও পেশাদার শিল্পীদের জন্য এটি এক বিশ্বস্ত আশ্রয়।',
            'rating' => 5,
            'photo' => 'frontend/assets/images/portfolio-casting.jpg',
            'is_featured' => true,
            'status' => true,
        ]);

        // 10. Settings
        Setting::set('site_name', 'Mind Blowing Media');
        Setting::set('site_tagline', 'Casting & Media House');
        Setting::set('site_email', 'casting@mindblowingmedia.bd');
        Setting::set('site_phone', '+৮৮০ ১৭০০-০০০১২৩');
        Setting::set('site_address', 'রোড ১১, বনানী, ঢাকা-১২১৩');
        Setting::set('showreel_url', 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&enablejsapi=1');
        Setting::set('stat_projects', '500+');
        Setting::set('stat_artists', '1200+');
        Setting::set('stat_films', '85+');
        Setting::set('stat_satisfaction', '99%');
    }
}
