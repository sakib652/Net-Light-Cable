@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center" style="max-width: 900px;">
            <h4 class="text-white display-6 mt-2 wow fadeInDown" data-wow-delay="0.1s">Employee Facilities</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item mb-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item active text-danger mb-4">Facilities</li>
            </ol>
        </div>
    </div>

    <!-- Employee Facilities Start -->
    <div class="container-fluid feature bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">আমাদের টিমের সদস্যদের জন্য আমরা যে মূল সুবিধা ও উপকারগুলো প্রদান করি তা নিচে উল্লেখ
                    করা হলো।</h4>
            </div>
            <div class="row g-4 pb-5">
                @php
                    $facilities = [
                        [
                            'icon' => 'fas fa-bullhorn',
                            'title' => 'ডিরেক্টর মার্কেটিং (DM)',
                            'desc' => [
                                'বেতন স্কেল ২৫০০০/- পচিশ হাজার টাকা',
                                'মোবাইল বিল বাবদ ২০০০/- দুই হাজার টাকা',
                                'দুপুরের খানা বাবদ ৩০০০/- তিন হাজার টাকা',
                                'দুই ঈদ বোনাস, বেতনের অর্ধেক',
                                'কোনো ধরনের অসুস্থতায় যেকোন হাসপাতালের ২০-৩০% ডিস্কাউন্ট',
                                'চাকরিরত অবস্থায় যাদের কোনো প্রকার দুর্ঘটনা অথবা স্বাভাবিক মৃত্যু হয় সেক্ষেত্রে উৎক নমিনীর হাতে বিদ্যুৎ বাংলাদেশের (PFP) ফান্ড থেকে এককালীন ১,০০,০০০/- এক লক্ষ টাকা ক্যাশ প্রদান করা হবে।',
                                'বিদ্যুৎ বাংলাদেশের তেল/গ্যাস সেলের উপর ২০% প্রফিট শেয়ার সকল পরিচালক ম্যানেজিংডিরেক্টর (MD)মহোদয়গণ কে দেওয়া হবে।',
                            ],
                        ],
                        [
                            'icon' => 'fas fa-user-tie',
                            'title' => 'ডেপুটি, ম্যানেজিং, পরিচালক (DMD)',
                            'desc' => [
                                'বেতন স্কেল ৫০,০০০/- টাকা।',
                                'মোবাইল বিল বাবদ ৪০০০/- টাকা।',
                                'দুপুরের খানা বাবদ ৬০০০/- টাকা।',
                                'মেডিকেল চেকআপ সার্ভিস ২০% থেকে ৩০% ছাড়।',
                                '২% বিজনেস প্রফিট শেয়ার।',
                                'ঈদ বোনাস বেতনের অর্ধেক পরিমাণ।',
                                'PFP ফান্ড বাবদ ১,৫০,০০০/- এক লক্ষ পঞ্চাশ হাজার টাকা। (বিঃ দ্রঃ) বিদ্যুৎ সার্ভিস বাবদ ২০০০ টাকা প্রদান করিতে হবে।',
                            ],
                        ],
                        [
                            'icon' => 'fas fa-user-cog',
                            'title' => 'ম্যানেজিং পরিচালক (MD)',
                            'desc' => [
                                'আপনার বেতন স্কেল তিন মাস পর্যন্ত চলু থাকবে। বেতন স্কেল হল ৭০,০০০/- টাকা।',
                                'মেডিকেল চেকআপ আজীবন ২০% থেকে ৩০% ছাড়।',
                                'PFP ফান্ড বাবদ বাজেট ২,০০,০০০/- টাকা।',
                                'বি ডি সি বাংলাদেশ প্রতিষ্ঠান হতে আজীবন ১% প্রফিট শেয়ার।',
                            ],
                        ],
                        [
                            'icon' => 'fas fa-users',
                            'title' => 'ডিপু, ফাউন্ডার, মেম্বার (DFM)',
                            'desc' => [
                                'ডিপু, ফাউন্ডার, মেম্বার (DFM) কমিশন ৫%',
                                'রয়্যালটি প্রতি মাস ১%',
                                'মেডিকেল চেকআপ ৩০% থেকে ৪০% ডিসকাউন্ট।',
                                'বি ডি সি বাংলাদেশ প্রতিষ্ঠানের মোট বিক্রয়ের উপর ১% সকল ডিপু ফাউন্ডার মেম্বারদের (DFM) মধ্যে বন্টন করা দেওয়া হবে।',
                                'PFP ফান্ড বাবদ এক লক্ষ টাকা',
                            ],
                        ],
                    ];
                @endphp

                @foreach ($facilities as $index => $facility)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.{{ $index + 2 }}s">
                        <div class="feature-item p-4 pt-0 h-100 d-flex flex-column facility-card">
                            <div class="feature-icon p-4 mb-4">
                                <i class="{{ $facility['icon'] }} fa-3x"></i>
                            </div>
                            <h4 class="mb-3">{{ $facility['title'] }}</h4>
                            <div class="facility-content">
                                <ul class="facility-list">
                                    @foreach ($facility['desc'] as $desc)
                                        <li>{{ $desc }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Employee Facilities End -->

    <style>
        .facility-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            height: 400px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .facility-card:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .facility-card:hover h4,
        .facility-card:hover .facility-list li,
        .facility-card:hover i {
            color: #fff;
        }

        .facility-content {
            overflow-y: auto;
            max-height: 250px;
        }

        .facility-list {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .facility-list li {
            margin-bottom: 8px;
            text-align: left;
            transition: color 0.3s;
        }
    </style>
@endsection
