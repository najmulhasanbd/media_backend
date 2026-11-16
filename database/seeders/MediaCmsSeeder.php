<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\CastingCall;
use App\Models\Category;
use App\Models\Faq;
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
        $catActor = Category::updateOrCreate(['slug' => 'actor'], ['name' => 'অভিনেতা', 'type' => 'talent', 'status' => true]);
        $catActress = Category::updateOrCreate(['slug' => 'actress'], ['name' => 'অভিনেত্রী', 'type' => 'talent', 'status' => true]);
        $catMaleModel = Category::updateOrCreate(['slug' => 'male-model'], ['name' => 'পুরুষ মডেল', 'type' => 'talent', 'status' => true]);
        $catFemaleModel = Category::updateOrCreate(['slug' => 'female-model'], ['name' => 'নারী মডেল', 'type' => 'talent', 'status' => true]);
        $catChild = Category::updateOrCreate(['slug' => 'child-artist'], ['name' => 'শিশুশিল্পী', 'type' => 'talent', 'status' => true]);
        $catForeign = Category::updateOrCreate(['slug' => 'international'], ['name' => 'বিদেশি শিল্পী', 'type' => 'talent', 'status' => true]);
        $catVoice = Category::updateOrCreate(['slug' => 'voice-artist'], ['name' => 'ভয়েস আর্টিস্ট', 'type' => 'talent', 'status' => true]);

        // 2. Hero Sliders (100% Real Bangladeshi Media Production Imagery)
        HeroSlider::truncate();
        HeroSlider::create([
            'badge' => '★ এক্সক্লুসিভ ট্যালেন্ট ডিরেক্টরি ২০২৬',
            'title' => 'বাংলা সিনেমা, নাটক ও ওটিটির <span class="text-gold-gradient">পূর্ণাঙ্গ কাস্টিং ও প্রোডাকশন</span>',
            'subtitle' => '১৮৫০+ ভেরিফাইড অভিনেতা, অভিনেত্রী ও মডেল রোস্টার নিয়ে দেশের শীর্ষস্থানীয় প্রযোজনা ও বিজ্ঞাপন কাস্টিং সলিউশন।',
            'image' => 'uploads/sliders/hero_cinema_bd.webp',
            'btn_text_1' => 'প্রোফাইল জমা দিন',
            'btn_url_1' => '#registration-section',
            'btn_text_2' => 'অফিসিয়াল শো-রিল',
            'btn_url_2' => 'https://www.youtube.com/watch?v=R9U0C93o27w',
            'order' => 1,
            'status' => true,
        ]);

        HeroSlider::create([
            'badge' => '★ প্রিমিয়াম ব্র্যান্ড প্রোডাকশন',
            'title' => 'টপ ব্র্যান্ডের জন্য <span class="text-gold-gradient">সিনেমাটিক কমার্শিয়াল ও মেগা ক্যাম্পেইন</span>',
            'subtitle' => 'টেলিকম, ব্যাংকিং ও এফএমসিজি ব্র্যান্ডের জন্য হাই-এন্ড ভিডিও প্রোডাকশন, মডেল নির্বাচন ও ডিরেকশন।',
            'image' => 'uploads/sliders/hero_commercial_bd.webp',
            'btn_text_1' => 'ভিডিও পোর্টফোলিও',
            'btn_url_1' => '/videos',
            'btn_text_2' => 'কাস্টিং কল দেখুন',
            'btn_url_2' => '#casting-calls',
            'order' => 2,
            'status' => true,
        ]);

        HeroSlider::create([
            'badge' => '★ ওয়ান-স্টপ শুটিং সলিউশন',
            'title' => 'পূবাইল, উত্তরা ও ঢাকার সেরা <span class="text-gold-gradient">শুটিং স্পট ও স্টুডিও সুবিধা</span>',
            'subtitle' => 'ঐতিহাসিক জমিদার বাড়ি, গ্রামীণ সেট ও সাউন্ডপ্রুফ এসি স্টুডিও ফ্লোর লজিস্টিকস এক ঠিকানায়।',
            'image' => 'uploads/sliders/hero_studio_bd.webp',
            'btn_text_1' => 'শুটিং হাউজ ক্যাটালগ',
            'btn_url_1' => '/shooting-houses',
            'btn_text_2' => 'যোগাযোগ করুন',
            'btn_url_2' => '#registration-section',
            'order' => 3,
            'status' => true,
        ]);

        // 3. Talents (12 Real Profiles with Distinct Photos, Specs & Bios)
        Talent::truncate();

        // Talent 1: Shariful Islam Rafi
        Talent::create([
            'category_id' => $catActor->id,
            'name' => 'শরিফুল ইসলাম রাফি',
            'specialty' => 'ওটিটি থ্রিলার ও অ্যাকশন লিড',
            'gender' => 'পুরুষ',
            'age' => '২৮ বছর',
            'height' => "5' 11\"",
            'experience' => '৫ বছর',
            'photo' => 'uploads/talents/talent_actor_1.webp',
            'bio' => 'ঢাকা বিশ্ববিদ্যালয় নাট্যকলা থেকে স্নাতক। ওটিটি ওয়েব সিরিজ ও শর্টফিল্মে প্রধান চরিত্রে নিয়মিত কাজ করছেন। ভয়েস মড্যুলেশন ও ফিজিক্যাল অ্যাকশনে পারদর্শী।',
            'audition_url' => 'https://www.youtube.com/watch?v=R9U0C93o27w',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 2: Tanjin Nawer Tisha
        Talent::create([
            'category_id' => $catActress->id,
            'name' => 'তানজিন নাওয়ার তিশা',
            'specialty' => 'সিরিয়াস ড্রামা ও রোমান্টিক লিড',
            'gender' => 'নারী',
            'age' => '২৫ বছর',
            'height' => "5' 5\"",
            'experience' => '৪ বছর',
            'photo' => 'uploads/talents/talent_actress_1.webp',
            'bio' => 'নাটক ও মেগা সিরিয়ালে জনপ্রিয় মুখ। প্রাণবন্ত উপস্থিতি, চমৎকার সংলাপ প্রক্ষেপণ এবং বহুমুখী চরিত্রে সাবলীল রূপদান।',
            'audition_url' => 'https://www.youtube.com/watch?v=5rT8yvB_GjQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 3: Farhan Zaman Aryan
        Talent::create([
            'category_id' => $catMaleModel->id,
            'name' => 'ফারহান জামান আরিয়ান',
            'specialty' => 'হাই-ফ্যাশন ও র‍্যাম্প মডেল',
            'gender' => 'পুরুষ',
            'age' => '২৬ বছর',
            'height' => "6' 1\"",
            'experience' => '৪ বছর',
            'photo' => 'uploads/talents/talent_model_1.webp',
            'bio' => 'শীর্ষস্থানীয় লাইফস্টাইল ব্র্যান্ড ও ফ্যাশন উইকের নিয়মিত মডেল। জিম ফিটনেস, বিলবোর্ড ও রানওয়ে ক্যাটওয়াকে অভিজ্ঞ।',
            'audition_url' => 'https://www.youtube.com/watch?v=tgbNymZ7vqY',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 4: Samira Haque Mehzabin
        Talent::create([
            'category_id' => $catFemaleModel->id,
            'name' => 'সামিরা হক মেহজাবিন',
            'specialty' => 'কমার্শিয়াল ও ফ্যাশন টিভিসি',
            'gender' => 'নারী',
            'age' => '২৩ বছর',
            'height' => "5' 7\"",
            'experience' => '৩ বছর',
            'photo' => 'uploads/talents/talent_model_2.webp',
            'bio' => 'বহুজাতিক ব্র্যান্ডের বিলবোর্ড ও টিভি কমার্শিয়ালে প্রধান মডেল। মেকআপ ও ক্যামেরা এক্সপ্রেশনে সহজাত দক্ষতা।',
            'audition_url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 5: Sadman Sakib Chowdhury
        Talent::create([
            'category_id' => $catActor->id,
            'name' => 'সাদমান সাকিব চৌধুরী',
            'specialty' => 'সাইকোলজিক্যাল ও ক্যারেক্টার রোল',
            'gender' => 'পুরুষ',
            'age' => '৩২ বছর',
            'height' => "5' 10\"",
            'experience' => '৭ বছর',
            'photo' => 'uploads/talents/talent_actor_2.webp',
            'bio' => 'থিয়েটার ব্যাকগ্রাউন্ডের অভিজ্ঞ অভিনেতা। ইনটেন্টিভ ক্যারেক্টার ও ডার্ক শেডের চরিত্রে বিশেষ পারদর্শিতা।',
            'audition_url' => 'https://www.youtube.com/watch?v=R9U0C93o27w',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 6: Sabrina Tasnim Oishee
        Talent::create([
            'category_id' => $catActress->id,
            'name' => 'সাবরিনা তাসনিম ঐশী',
            'specialty' => 'ক্লাসিক্যাল ড্রামা ও চলচ্চিত্র',
            'gender' => 'নারী',
            'age' => '২৪ বছর',
            'height' => "5' 4\"",
            'experience' => '৩ বছর',
            'photo' => 'uploads/talents/talent_actress_2.webp',
            'bio' => 'কত্থক নৃত্যে পারদর্শী এবং ক্লাসিক্যাল ধারার চলচ্চিত্রে প্রধান চরিত্রে প্রশংসিত। চমৎকার বাচনভঙ্গি।',
            'audition_url' => 'https://www.youtube.com/watch?v=5rT8yvB_GjQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 7: Jarif Al Hasan (Child Artist)
        Talent::create([
            'category_id' => $catChild->id,
            'name' => 'ছোট্ট জারিফ আল হাসান',
            'specialty' => 'টিভি বিজ্ঞাপন ও ইমোশনাল ড্রামা',
            'gender' => 'পুরুষ',
            'age' => '৮ বছর',
            'height' => "4' 1\"",
            'experience' => '২ বছর',
            'photo' => 'uploads/talents/talent_child_1.webp',
            'bio' => 'দুধ ও বিস্কুটের বিজ্ঞাপনে চঞ্চল ও কিউট পারফরম্যান্স দিয়ে দর্শকনন্দিত। ক্যামেরার সামনে যেকোনো সংলাপ সহজে মনে রাখতে পারে।',
            'audition_url' => 'https://www.youtube.com/watch?v=tgbNymZ7vqY',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 8: Ayra Tabassum Megha (Child Artist)
        Talent::create([
            'category_id' => $catChild->id,
            'name' => 'আয়রা তাবাসসুম মেঘা',
            'specialty' => 'কিউট এক্সপ্রেশন ও বিজ্ঞাপন',
            'gender' => 'নারী',
            'age' => '৭ বছর',
            'height' => "3' 10\"",
            'experience' => '২ বছর',
            'photo' => 'uploads/talents/talent_child_2.webp',
            'bio' => 'মিষ্টি হাসি ও ন্যাচারাল অভিনয়ে একাধিক টেলিকম ও আইসক্রিমের বিজ্ঞাপনে প্রধান শিশুশিল্পী হিসেবে প্রশংসিত।',
            'audition_url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 9: Sofia Maria (International Model)
        Talent::create([
            'category_id' => $catForeign->id,
            'name' => 'সোফিয়া মারিয়া শেরভানোভা',
            'specialty' => 'ইউরোপিয়ান ফ্যাশন ও গ্লোবাল টিভিসি',
            'is_international' => true,
            'gender' => 'নারী',
            'age' => '২৩ বছর',
            'height' => "5' 10\"",
            'experience' => '৫ বছর',
            'photo' => 'uploads/talents/talent_intl_1.webp',
            'bio' => 'ইউরোপিয়ান বংশোদ্ভূত আন্তর্জাতিক মডেল। যৌথ প্রযোজনা, গ্লোবাল রানওয়ে ও আন্তর্জাতিক কসমেটিকস ব্র্যান্ডের মডেল হিসেবে কাজ করেছেন।',
            'audition_url' => 'https://www.youtube.com/watch?v=tgbNymZ7vqY',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 10: Alexander Petrov (International Model)
        Talent::create([
            'category_id' => $catForeign->id,
            'name' => 'আলেক্সান্ডার পেট্রভ',
            'specialty' => 'কমার্শিয়াল ও আন্তর্জাতিক কর্পোরেট মডেল',
            'is_international' => true,
            'gender' => 'পুরুষ',
            'age' => '২৯ বছর',
            'height' => "6' 2\"",
            'experience' => '৬ বছর',
            'photo' => 'uploads/talents/talent_intl_2.webp',
            'bio' => 'আন্তর্জাতিক ফ্যাশন উইক ও কর্পোরেট ক্যাম্পেইনের অভিজ্ঞ ইউরোপিয়ান মডেল ও অভিনেতা।',
            'audition_url' => 'https://www.youtube.com/watch?v=R9U0C93o27w',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 11: Koushik Roy Mugdho
        Talent::create([
            'category_id' => $catActor->id,
            'name' => 'কৌশিক রায় মুগ্ধ',
            'specialty' => 'রোমান্টিক কমেডি ও ক্যাম্পাস ড্রামা',
            'gender' => 'পুরুষ',
            'age' => '২৪ বছর',
            'height' => "5' 9\"",
            'experience' => '৩ বছর',
            'photo' => 'uploads/talents/talent_actor_3.webp',
            'bio' => 'তরুণদের প্রিয় ক্যাম্পাস ভিত্তিক নাটক ও ট্রেন্ডিং মিউজিক ভিডিওর লিড অভিনেতা। ফ্রেশ স্ক্রিন প্রেজেন্স।',
            'audition_url' => 'https://www.youtube.com/watch?v=kXYiU_JCYtU',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // Talent 12: Nazneen Farhana Ety
        Talent::create([
            'category_id' => $catActress->id,
            'name' => 'নাজনীন ফারহানা ইতি',
            'specialty' => 'পিরিয়ড ড্রামা ও থিয়েটার অভিনয়',
            'gender' => 'নারী',
            'age' => '২৭ বছর',
            'height' => "5' 6\"",
            'experience' => '৫ বছর',
            'photo' => 'uploads/talents/talent_actress_3.webp',
            'bio' => 'ঐতিহাসিক ও সাহিত্যনির্ভর টেলিফিল্মে শক্তিশালী অভিনয়ের জন্য সুপরিচিত। দীর্ঘদিনের মঞ্চ নাটকের অভিজ্ঞতা রয়েছে।',
            'audition_url' => 'https://www.youtube.com/watch?v=5rT8yvB_GjQ',
            'portfolio_url' => 'https://drive.google.com',
            'is_verified' => true,
            'is_featured' => true,
            'status' => true,
        ]);

        // 4. Casting Calls (4 Realistic Current Calls)
        CastingCall::truncate();
        CastingCall::create([
            'title' => 'পূর্ণদৈর্ঘ্য বাণিজ্যিক চলচ্চিত্রের প্রধান খলনায়ক ও পুলিশ চরিত্র অডিশন',
            'project_type' => 'সিনেমা',
            'roles' => 'প্রধান খলনায়ক (বয়স ৩৫-৪৫) ও পুলিশ ইন্সপেক্টর (বয়স ৩০-৪০)',
            'requirements' => 'শক্তিশালী শারীরিক গঠন, বলিষ্ঠ কণ্ঠস্বর ও অ্যাকশন সিকোয়েন্সে সাবলীল হতে হবে। সম্মানী ১,৫০,০০০ - ৩,০০,০০০ ৳।',
            'deadline' => '১৫ ডিসেম্বর ২০২৬',
            'location' => 'বনানী স্টুডিও, ঢাকা',
            'status' => 'urgent',
        ]);

        CastingCall::create([
            'title' => 'শীর্ষস্থানীয় টেলিকম মেগা উৎসব ক্যাম্পেইনের জন্য প্রাণবন্ত তরুণ মডেল',
            'project_type' => 'টিভিসি',
            'roles' => 'বিশ্ববিদ্যালয় তরুণ-তরুণী (বয়স ২০-২৬)',
            'requirements' => 'উজ্জ্বল চেহারা, প্রাণবন্ত হাসি ও ক্যামেরার সামনে আত্মবিশ্বাসী এক্সপ্রেশন থাকতে হবে। সম্মানী ৮০,০০০ ৳ / পারফর্মার।',
            'deadline' => '২২ নভেম্বর ২০২৬',
            'location' => 'রেডিয়েন্ট স্টুডিও ফ্লোর, তেজগাঁও, ঢাকা',
            'status' => 'open',
        ]);

        CastingCall::create([
            'title' => 'ওটিটি থ্রিলার ওয়েব সিরিজের অনুসন্ধানী সাংবাদিক ও হ্যাকার রোল',
            'project_type' => 'ওটিটি',
            'roles' => 'অনুসন্ধানী সাংবাদিক (নারী, ২৫-৩০) ও সাইবার স্পেশালিস্ট (পুরুষ, ২৪-৩২)',
            'requirements' => 'ন্যাচারাল ডায়ালগ ডেলিভারি, তীক্ষ্ণ দৃষ্টি ও মেথড অ্যাক্টিংয়ে অভিজ্ঞতা অগ্রাধিকারযোগ্য। সম্মানী ২,০০,০০০ ৳ প্রজেক্ট চুক্তি।',
            'deadline' => '২৮ নভেম্বর ২০২৬',
            'location' => 'উত্তরা শুটিং জোন, ঢাকা',
            'status' => 'open',
        ]);

        CastingCall::create([
            'title' => 'আন্তর্জাতিক কসমেটিকস ও স্কিনকেয়ার ব্র্যান্ডের বিলবোর্ড ও ভিডিও শুট',
            'project_type' => 'বিজ্ঞাপন',
            'roles' => 'ফিমেল ফ্যাশন মডেল (উচ্চতা ৫\' ৭"+)',
            'requirements' => 'উজ্জ্বল ত্বক, প্রফেশনাল ফটোশুট পোর্টফোলিও এবং গ্রেসফুল পোস্টার প্রেজেন্টেশন। সম্মানী ১,২০,০০০ ৳।',
            'deadline' => '১০ ডিসেম্বর ২০২৬',
            'location' => 'গুলশান-২ স্টুডিও, ঢাকা',
            'status' => 'open',
        ]);

        // 5. Videos (6 Real BD Cinema, Drama, TVC, Music Productions)
        Video::truncate();
        Video::create([
            'category' => 'cinema',
            'title' => 'সুড়ঙ্গ (Surongo) — অফিশিয়াল সিনেমা ট্রেলার',
            'director' => 'রায়হান রাফী',
            'client' => 'চরকি ও আলফা আই',
            'duration' => '2:48 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=R9U0C93o27w',
            'thumbnail' => 'uploads/videos/video_surongo.webp',
            'description' => 'এক অপ্রতিরোধ্য লোভ ও রহস্যের গল্প নিয়ে নির্মিত ব্লকবাস্টার অ্যাকশন থ্রিলার চলচ্চিত্র।',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'cinema',
            'title' => 'তুফান (Toofan) — সিনেমাটিক ফার্স্ট লুক টিজার',
            'director' => 'রায়হান রাফী',
            'client' => 'এসভিএফ ও চরকি',
            'duration' => '2:15 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=FjU8xS77eZ8',
            'thumbnail' => 'uploads/videos/video_toofan.webp',
            'description' => 'নব্বই দশকের গ্যাংস্টার ড্রামা নির্ভর মেগা বাজেট বাণিজ্যিক সিনেমা প্রযোজনা।',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'drama',
            'title' => 'পুনর্জন্ম (Punorjonmo) — মনস্তাত্ত্বিক থ্রিলার স্পেশাল',
            'director' => 'ভিকি জাহেদ',
            'client' => 'চ্যানেল আই প্রাইম',
            'duration' => '44:20 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=5rT8yvB_GjQ',
            'thumbnail' => 'uploads/videos/video_punorjonmo.webp',
            'description' => 'রান্নার স্বাদ ও রহস্যময় খুনের যোগসূত্রে নির্মিত বাংলাদেশের অন্যতম আলোচিত সাইকোলজিক্যাল ড্রামা।',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'tvc',
            'title' => 'বিকাশ (bKash) — প্রিয়জনের হাসিমুখ ক্যাম্পেইন টিভিসি',
            'director' => 'অমিতাভ রেজা চৌধুরী',
            'client' => 'বিকাশ লিমিটেড',
            'duration' => '1:15 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=tgbNymZ7vqY',
            'thumbnail' => 'uploads/videos/video_bkash.webp',
            'description' => 'দেশের প্রতিটি প্রান্তে ভালোবাসা ও নিরাপত্তা পৌঁছে দেওয়ার ইমোশনাল ব্র্যান্ড স্টোরি।',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'tvc',
            'title' => 'গ্রামীণফোন (Grameenphone) — ৪জি মেগা নেটওয়ার্ক টিভিসি',
            'director' => 'পিপলু আর খান',
            'client' => 'গ্রামীণফোন বাংলাদেশ',
            'duration' => '0:55 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
            'thumbnail' => 'uploads/videos/video_gp.webp',
            'description' => 'সমগ্র বাংলাদেশজুড়ে ডিজিটাল অগ্রযাত্রার দ্রুততম সংযোগের সিনেমাটিক কমার্শিয়াল।',
            'is_featured' => true,
            'status' => true,
        ]);

        Video::create([
            'category' => 'music',
            'title' => 'হৃদমাঝারে — সিনেমাটিক ড্রামা মিউজিক্যাল ফিল্ম',
            'director' => 'তানিম রহমান অংশু',
            'client' => 'সাউন্ডটেক বিডি',
            'duration' => '4:30 মিনিট',
            'youtube_url' => 'https://www.youtube.com/watch?v=kXYiU_JCYtU',
            'thumbnail' => 'uploads/videos/video_music.webp',
            'description' => 'অপরূপ বান্দরবানের পাহাড়ি লোকেশনে চিত্রায়িত প্রেমের এক আবেগঘন সঙ্গীতচিত্র।',
            'is_featured' => true,
            'status' => true,
        ]);

        // 6. Shooting Houses (4 Authentic Bangladeshi Spots)
        ShootingHouse::truncate();
        ShootingHouse::create([
            'name' => 'পূবাইল জমিদার বাড়ি শুটিং প্যালেস',
            'location' => 'পূবাইল, গাজীপুর (ঢাকা থেকে মাত্র ৩৫ কিমি)',
            'rent' => '৳ ২৫,০০০ / দিন',
            'contact' => '+৮৮০ ১৭৫৫-৪৪৩৩২২',
            'facilities' => '৫ একর দিঘি ও আমবাগান, ১০০ বছরের পুরনো জমিদার বাড়ি, ৩টি এসি মেকআপ রুম, ২০০ কেভিএ সাইলেন্ট জেনারেটর, ড্রোন শুটিং পারমিট।',
            'description' => 'ঐতিহাসিক সিনেমা, নাটক ও পিরিয়ড ড্রামার শুটিংয়ের জন্য বাংলাদেশের সবচেয়ে ঐতিহ্যবাহী এবং সুরক্ষিত শুটিং স্পট। বিশাল পার্কিং ও নিরাপত্তা ব্যবস্থা।',
            'image' => 'uploads/houses/house_pubail.webp',
            'status' => true,
        ]);

        ShootingHouse::create([
            'name' => 'মেঘবিলা শুটিং ভিলা ও সুইমিং স্পট',
            'location' => 'সেক্টর ৪, উত্তরা, ঢাকা',
            'rent' => '৳ ১৮,০০০ / দিন',
            'contact' => '+৮৮০ ১৯১২-৮৮৭৭৬৬',
            'facilities' => 'আধুনিক ডুপ্লেক্স বাংলো, রুফটপ ইনফিনিটি সুইমিং পুল, ২টি লাক্সারি মেকআপ রুম, সেন্ট্রাল এসি, হাই-ভোল্টেজ লাইটিং বোর্ড।',
            'description' => 'টিভি বিজ্ঞাপন, ফ্যাশন শুট ও শহুরে কর্পোরেট নাটকের জন্য নান্দনিক ইন্টেরিয়র সেট। মনোরম টেরেস ও আধুনিক ফার্নিচার সুবিধা।',
            'image' => 'uploads/houses/house_meghbila.webp',
            'status' => true,
        ]);

        ShootingHouse::create([
            'name' => 'আপন ঘর গ্রামীণ শুটিং হাউস',
            'location' => 'উলুখোলা, কালীগঞ্জ, গাজীপুর',
            'rent' => '৳ ১৫,০০০ / দিন',
            'contact' => '+৮৮০ ১৮৩৩-৯৯৮৮৭৭',
            'facilities' => 'মাটির ঘর ও ছনের কুঁড়েঘর, ঘাটবাঁধানো পুকুর, কাঠের ঢেকিশালা, খড়ের গাদা, ১০০% প্রাকৃতিক গ্রামীণ গাছপালা ও শুটার ডাইনিং।',
            'description' => 'গ্রামীণ জীবনের পটভূমিতে নির্মিত সিনেমা, একক নাটক ও লোকজ গানের মিউজিক ভিডিওর জন্য নিখুঁত প্রাকৃতিক শুটিং ভেন্যু।',
            'image' => 'uploads/houses/house_aponghor.webp',
            'status' => true,
        ]);

        ShootingHouse::create([
            'name' => 'ঢাকা সেন্ট্রাল সাউন্ড স্টুডিও ও ক্রোমা ফ্লোর',
            'location' => 'রোড ১১, বনানী সি/এ, ঢাকা-১২১৩',
            'rent' => '৳ ৩০,০০০ / দিন',
            'contact' => '+৮৮০ ১৭০০-০০১২৩৪',
            'facilities' => '৩০০০ বর্গফুট সাউন্ডপ্রুফ শুটিং ফ্লোর, ফুল গ্রিনস্ক্রিন ক্রোমা ব্যাকড্রপ, গ্রিড ট্রাস লাইটিং, ডলবি অ্যাটমস মনিটরিং লাউঞ্জ।',
            'description' => 'বিজ্ঞাপনের স্পেশাল ইফেক্ট, ভিএফএক্স শট, ডাবিং ও মাল্টিক্যামেরা লাইভ রেকর্ডিংয়ের জন্য বিশ্বমানের আধুনিক ইনডোর স্টুডিও।',
            'image' => 'uploads/houses/house_dhaka_studio.webp',
            'status' => true,
        ]);

        // 7. Articles & Diaries (6 Thoughtful Bangladeshi Industry Stories)
        Article::truncate();
        Article::create([
            'type' => 'director',
            'title' => 'চরিত্রের ভেতরে চরিত্র: মেথড অ্যাক্টিং বনাম স্বতঃস্ফূর্ত অভিনয়',
            'slug' => 'method-acting-vs-spontaneous-acting',
            'author_name' => 'অমিতাভ রেজা চৌধুরী',
            'author_role' => 'চলচ্চিত্র ও বিজ্ঞাপন নির্মাতা',
            'author_image' => 'uploads/authors/author_amitabh.webp',
            'content' => 'ক্যামেরা যখন অ্যাকশন বলে, তখন একজন অভিনেতা কেবল স্ক্রিপ্টের সংলাপ আওড়ান না, তিনি তৈরি করেন এক স্বতন্ত্র মহাবিশ্ব। আয়নাবাজি নির্মাণের সময় চঞ্চলের প্রতিটি রূপান্তর ছিল দীর্ঘ অনুশীলনের ফল। আমাদের নতুন প্রজন্মের শিল্পীদের জন্য কাস্টিং রুমে আমার প্রথম পরামর্শ থাকে—চরিত্রকে ধারণ করো, অভিনয় করার চেষ্টা কোরো না। নিজের অভিজ্ঞতা ও আবেগের সাথে চরিত্রের মেলবন্ধন ঘটাতে পারলেই অভিনয় জীবন্ত হয়ে ওঠে।',
            'image' => 'uploads/articles/article_directors.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'director',
            'title' => 'ওটিটির নতুন যুগ: চিত্রনাট্য নির্বাচনের আধুনিক কৌশল ও রূপরেখা',
            'slug' => 'new-era-of-bangladeshi-ott-script-selection',
            'author_name' => 'আশফাক নিপুণ',
            'author_role' => 'চলচ্চিত্র ও ওটিটি নির্মাতা',
            'author_image' => 'uploads/authors/author_ashfaque.webp',
            'content' => 'গত পাঁচ বছরে আমাদের কনটেন্টের ব্যাকরণ আমূল বদলে গেছে। এখন আর গতানুগতিক লাউড ডায়ালগ দিয়ে দর্শককে আটকে রাখা যায় না। মহানগর সিরিজের প্রতিটি চরিত্র নির্বাচন ছিল একটি জটিল দাবা খেলার মতো। প্রতিটি ফ্রেমের সত্যতা নির্ভর করে নিখুঁত কাস্টিংয়ের ওপর। যখন একজন অভিনয়শিল্পী চরিত্রের মনস্তত্ত্ব বুঝতে পারেন, তখন পরিচালকের কাজ অনেক সহজ হয়ে যায়।',
            'image' => 'uploads/articles/article_cinema.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'artist',
            'title' => 'প্রথম অডিশন থেকে বড় পর্দা: একজন নবীন শিল্পীর টিকে থাকার সংগ্রাম',
            'slug' => 'first-audition-to-silver-screen-survival-journey',
            'author_name' => 'তানজিন নাওয়ার তিশা',
            'author_role' => 'অভিনেত্রী',
            'author_image' => 'uploads/talents/talent_actress_1.webp',
            'content' => 'এখনো মনে পড়ে আমার জীবনের প্রথম অডিশনের দিনটির কথা। বনানীর এক ছোট স্টুডিওতে শতাধিক প্রতিযোগীর মাঝে দাঁড়িয়ে হাত-পা কাঁপছিল। কিন্তু ক্যামেরা যখন আমার চোখের দিকে তাকাল, তখন সমস্ত ভয় মুছে গিয়ে জেগে উঠল চরিত্রের গভীর অনুভূতি। প্রত্যাখ্যান মেনে নেওয়া এবং প্রতিদিন নিজের ক্রাফটকে শাণিত করাই এই ইন্ডাস্ট্রির আসল মন্ত্র। ধৈর্য আর সততা থাকলে সাফল্য আসবেই।',
            'image' => 'uploads/articles/article_artists.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'artist',
            'title' => 'ক্যামেরার সাথে বন্ধুত্ব: মডেলিং থেকে অভিনয়ের রূপান্তর যাত্রা',
            'slug' => 'friendship-with-camera-modeling-to-acting-transition',
            'author_name' => 'ফারহান জামান আরিয়ান',
            'author_role' => 'মডেল ও অভিনেতা',
            'author_image' => 'uploads/talents/talent_model_1.webp',
            'content' => 'র‍্যাম্পে হাঁটা আর একটি চরিত্রের কান্না-হাসিতে প্রাণ দেওয়া সম্পূর্ণ ভিন্ন মেরুর বিষয়। মডেলিং আমাকে শিখিয়েছে ক্যামেরার আলো আর ফ্রেম বুঝতে, কিন্তু অভিনয় আমাকে শিখিয়েছে মানুষের হৃদস্পন্দনকে স্পর্শ করতে। প্রতিটি নতুন দৃশ্য আমার কাছে একটি নতুন জীবন যাপনের মতো রোমাঞ্চকর।',
            'image' => 'uploads/articles/article_modeling.webp',
            'is_featured' => false,
            'status' => true,
        ]);

        Article::create([
            'type' => 'opinion',
            'title' => 'বাংলাদেশের চলচ্চিত্র ও ওটিটি ইন্ডাস্ট্রি: বিশ্বমঞ্চে আমাদের উজ্জ্বল সম্ভাবনা',
            'slug' => 'bangladeshi-cinema-and-ott-global-prospects',
            'author_name' => 'মাইন্ড ব্লোয়িং মিডিয়া রিসার্চ টিম',
            'author_role' => 'সম্পাদকীয় পরিষদ',
            'author_image' => 'uploads/authors/author_ashfaque.webp',
            'content' => 'বাংলা ভাষার কনটেন্ট আজ শুধু ঢাকা বা কলকাতাতেই সীমাবদ্ধ নয়; আন্তর্জাতিক ওটিটি প্ল্যাটফর্মগুলোর মাধ্যমে বিশ্বব্যাপী ছড়িয়ে পড়ছে। এই রূপান্তরের কেন্দ্রে রয়েছে সঠিক কাস্টিং ও দক্ষ কারিগরি ডিরেকশন। আমাদের প্রতিভাবান তরুণ প্রজন্ম আন্তর্জাতিক মানের ভিজ্যুয়াল তৈরিতে এখন পিছিয়ে নেই।',
            'image' => 'uploads/articles/article_opinion.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Article::create([
            'type' => 'opinion',
            'title' => 'কাস্টিং ডিরেকশন কেন একটি প্রোডাকশনের প্রাণভ্রমরা?',
            'slug' => 'why-casting-direction-is-the-heart-of-production',
            'author_name' => 'রাশেদ মাহমুদ',
            'author_role' => 'হেড অব কাস্টিং ডিরেকশন',
            'author_image' => 'uploads/authors/author_amitabh.webp',
            'content' => 'একটি ভালো চিত্রনাট্যও ভুল কাস্টিংয়ের কারণে ব্যর্থ হতে পারে, আবার একজন অসাধারণ অভিনেতা সাধারণ সংলাপকেও কালজয়ী করে তুলতে পারেন। পশ্চিমা বিশ্বে কাস্টিং ডিরেক্টর একাডেমি অ্যাওয়ার্ড পেতে যাচ্ছেন, আমাদের দেশেও এই পেশার প্রাতিষ্ঠানিক স্বীকৃতি এখন সময়ের দাবি।',
            'image' => 'uploads/articles/article_casting.webp',
            'is_featured' => false,
            'status' => true,
        ]);

        // 8. Notices (3 Official Active Notices)
        Notice::truncate();
        Notice::create([
            'title' => '২০২৬ সালের শীতকালীন মেগা অডিশন ও ট্যালেন্ট হান্ট রেজিস্ট্রেশন শুরু',
            'date' => '১৫ নভেম্বর ২০২৬',
            'description' => 'নাটক, চলচ্চিত্র ও বিজ্ঞাপনের জন্য নতুন মুখের খোঁজে মাইন্ড ব্লোয়িং মিডিয়ার দেশব্যাপী রেজিস্ট্রেশন ড্রাইভ চলছে। নতুন ও অভিজ্ঞ শিল্পীদের পোর্টফোলিওসহ সরাসরি আমাদের ওয়েবসাইটে আবেদন করার আহ্বান জানানো হচ্ছে। নির্বাচিতদের সাথে সরাসরি যোগাযোগ করা হবে।',
            'is_pinned' => true,
            'status' => true,
        ]);

        Notice::create([
            'title' => 'আন্তর্জাতিক বিজ্ঞাপন ক্যাম্পেইনের সেলফ-টেপ অডিশন জমা দেওয়ার নিয়মাবলী',
            'date' => '১২ নভেম্বর ২০২৬',
            'description' => 'বিদেশি যৌথ প্রযোজনার বিজ্ঞাপনে অংশগ্রহণের জন্য কোনো ফিল্টার ছাড়া দিনের স্বাভাবিক আলোয় ২ মিনিটের মনোলোগ সেলফ-টেপ ধারণ করে গুগল ড্রাইভ লিংক পাঠাতে হবে। ল্যান্ডস্কেপ মোডে ৪কে অথবা ১০৮০পি রেজ্যুলেশন বাধ্যতামূলক।',
            'is_pinned' => false,
            'status' => true,
        ]);

        Notice::create([
            'title' => 'পূবাইল ও উত্তরা শুটিং হাউজে শুটিং পারমিশন ও বুকিং সংক্রান্ত জরুরি নির্দেশনা',
            'date' => '০৮ নভেম্বর ২০২৬',
            'description' => 'শুটিং ইউনিটের যানবাহন ও জেনারেটরের লজিস্টিকস ছাড়পত্র নিশ্চিত করার স্বার্থে শুটিং তারিখের অন্তত ৭ দিন পূর্বে হাউজ বুকিং নিশ্চিত করার অনুরোধ জানানো হচ্ছে। অফিশিয়াল চুক্তিপত্র ছাড়া কোনো বুকিং চূড়ান্ত বলে গণ্য হবে না।',
            'is_pinned' => false,
            'status' => true,
        ]);

        // 9. Reviews (4 Top Filmmaker & Client Reviews with Real Photos)
        Review::truncate();
        Review::create([
            'name' => 'রেদওয়ান রনি',
            'designation' => 'সিইও, চরকি (Chorki) ও চলচ্চিত্র নির্মাতা',
            'rating' => 5,
            'review' => 'মাইন্ড ব্লোয়িং মিডিয়ার কাস্টিং ব্যাংক আমাদের ওয়েব সিরিজের কাস্টিং প্রক্রিয়াকে অত্যন্ত গতিশীল ও পেশাদার করেছে। বিশেষ করে তাদের ভেরিফাইড নতুন প্রতিভারা সত্যিই প্রশংসার দাবিদার। প্রি-প্রোডাকশনের সময় এক নিমিষেই অনেক কমে গেছে।',
            'photo' => 'uploads/reviews/review_redoan.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Review::create([
            'name' => 'অমিতাভ রেজা চৌধুরী',
            'designation' => 'চলচ্চিত্র ও বিজ্ঞাপন নির্মাতা, হাফ স্টপ ডাউন',
            'rating' => 5,
            'review' => 'বিজ্ঞাপনের জন্য যখন একদম ইউনিক এবং ন্যাচারাল অ্যাক্টিং জানা মুখ প্রয়োজন হয়, তখন মাইন্ড ব্লোয়িং মিডিয়াই আমার প্রথম ভরসা। তাদের শুটিং হাউজ ও স্টুডিও লজিস্টিকস অত্যন্ত নিখুঁত ও নির্ভরযোগ্য।',
            'photo' => 'uploads/reviews/review_amitabh.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Review::create([
            'name' => 'তানিয়া আহমেদ',
            'designation' => 'হেড অব ক্রিয়েটিভ, মিডিয়াকম বাংলাদেশ',
            'rating' => 5,
            'review' => 'টেলিকম ও ব্যাংকিং ব্র্যান্ড ক্যাম্পেইনে মডেল নির্বাচন থেকে শুরু করে আউটডোর স্পট বুকিং—সবকিছুতেই তাদের সময়ানুবর্তিতা এবং প্রফেশনালিজম অসাধারণ। তাদের সাথে কাজ করা সবসময়ই আনন্দের।',
            'photo' => 'uploads/reviews/review_tania.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        Review::create([
            'name' => 'সৈয়দ আহমেদ শাওন',
            'designation' => 'নির্বাহী প্রযোজক, আলফা আই স্টুডিওজ',
            'rating' => 5,
            'review' => 'অভিনয়শিল্পীদের তথ্য, সঠিক বয়স ও উচ্চতার নির্ভুল প্রোফাইল ডিরেক্টরি পাওয়ায় আমাদের প্রি-প্রোডাকশন কাস্টিং খরচ ও সময় অর্ধেকেরও বেশি বেঁচে গেছে। শুভকামনা পুরো টিমকে।',
            'photo' => 'uploads/reviews/review_shaon.webp',
            'is_featured' => true,
            'status' => true,
        ]);

        // 10. FAQs (5 Comprehensive Authentic Questions)
        Faq::truncate();
        Faq::create([
            'question' => 'মাইন্ড ব্লোয়িং মিডিয়া পোর্টালে শিল্পী হিসেবে রেজিস্ট্রেশন করার প্রক্রিয়া কী?',
            'answer' => 'হোমপেজের "প্রোফাইল জমা দিন" ফর্মে আপনার নাম, যোগাযোগের ফোন/হোয়াটসঅ্যাপ নম্বর, সঠিক বয়স, উচ্চতা, স্পষ্ট ছবি এবং কাজের লিংক দিয়ে সাবমিট করুন। আমাদের কাস্টিং টিম তথ্য যাচাই করে আপনাকে অভ্যন্তরীণ রোস্টারে যুক্ত করবে।',
            'order' => 1,
            'status' => true,
        ]);

        Faq::create([
            'question' => 'রেজিস্ট্রেশনের জন্য কি কোনো ফি দিতে হয়?',
            'answer' => 'না, আমাদের প্ল্যাটফর্মে প্রাথমিক রেজিস্ট্রেশন ও প্রোফাইল জমা দেওয়া সম্পূর্ণ ফ্রি। চরিত্র অনুযায়ী অডিশন কল পাওয়ার পরই কেবল চূড়ান্ত নির্বাচনের স্ক্রিনিং প্রক্রিয়া শুরু হয়।',
            'order' => 2,
            'status' => true,
        ]);

        Faq::create([
            'question' => 'প্রোজেক্টের জন্য শিল্পী নির্বাচন হলে কাস্টিং টিম কীভাবে যোগাযোগ করে?',
            'answer' => 'কোনো নাটক, সিনেমা বা বিজ্ঞাপনে আপনার সাথে চরিত্রের মিল থাকলে আমাদের কাস্টিং টিম সরাসরি আপনার দেওয়া হোয়াটসঅ্যাপ নম্বর অথবা ফোনে যোগাযোগ করে ব্রিফিং প্রদান করবে।',
            'order' => 3,
            'status' => true,
        ]);

        Faq::create([
            'question' => 'নির্মাতা বা এজেন্সি কীভাবে শুটিং হাউজ বা স্টুডিও বুকিং করতে পারেন?',
            'answer' => 'শুটিং হাউজ সেকশন থেকে আপনার পছন্দের লোকেশন নির্বাচন করে সরাসরি আমাদের অফিসিয়াল নম্বরে কল অথবা হোয়াটসঅ্যাপে যোগাযোগ করে শুটিং তারিখের সিডিউল কনফার্ম করতে পারেন।',
            'order' => 4,
            'status' => true,
        ]);

        Faq::create([
            'question' => 'বিদেশি বা আন্তর্জাতিক অভিনয়শিল্পীদের কীভাবে বুকিং করা যায়?',
            'answer' => 'বিদেশি শিল্পীদের কাজের জন্য আমাদের লিগ্যাল ও ভিসা প্রসেসিং দল প্রয়োজনীয় ওয়ার্ক পারমিট ও চুক্তিপত্র সম্পন্ন করে সরাসরি ঢাকা বা আউটডোর লোকেশনে উপস্থিতির ব্যবস্থা করে থাকে।',
            'order' => 5,
            'status' => true,
        ]);

        // 11. Settings (Real Brand Info, Contact, Metrics & Social)
        Setting::set('site_name', 'Mind Blowing Media');
        Setting::set('site_tagline', 'কাস্টিং ও মিডিয়া প্রোডাকশন হাউস');
        Setting::set('site_phone', '+880 1700-000123');
        Setting::set('site_whatsapp', '+880 1700-000123');
        Setting::set('site_email', 'casting@mindblowingmedia.bd');
        Setting::set('site_address', 'প্লট ৪২, রোড ১১, ব্লক ডি, বনানী, ঢাকা-১২১৩');
        Setting::set('showreel_url', 'https://www.youtube.com/watch?v=R9U0C93o27w');
        Setting::set('stat_projects', '550+');
        Setting::set('stat_artists', '1850+');
        Setting::set('stat_films', '45+');
        Setting::set('stat_satisfaction', '99%');
        Setting::set('social_facebook', 'https://facebook.com');
        Setting::set('social_instagram', 'https://instagram.com');
        Setting::set('social_youtube', 'https://youtube.com');
        Setting::set('social_vimeo', 'https://vimeo.com');
    }
}
