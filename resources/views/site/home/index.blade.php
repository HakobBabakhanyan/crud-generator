@extends('site.layouts.app')

@section('content')
    <!-- Slider main container -->
    <div class="swiper-container slider-home relative">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @for($i=0;$i<4;$i++)
                <div class="swiper-slide relative">
                    <img class="w-full brightness-5" src="{{ asset('img/site/slider.jpg') }}" alt="">
                    <div class="absolute z-10 w-full h-full inset-0">
                        <div class="flex flex-column w-full h-full justify-center items-center">
                            <div class="w-3/5 bg-white-op-8 p-5 relative">
                                <p class="inline-block text-blue text-6xl ">Учебно-спортивный комплекс</p>
                                <p class="inline-block text-black text-custom-xl">
                                    Здравствуйте, дорогие родители, так как сейчас много частных и государственных
                                    детских садов, когда речь идет о том здравствуйте, дорогие родители, так как сейчас
                                    много частных и
                                </p>
                                <button
                                    class="bg-blue hover:bg-transparent  text-white font-bold py-2 px-4 p-bottom-right">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <!-- If we need navigation buttons -->
        <div class="absolute bottom-0 right-0 z-10 flex">
            <button class="flex bg-white text-black font-bold py-2 px-3 focus:outline-none slider-home-prev">
                <i class="mdi mdi-arrow-left text-2xl leading-none"></i>
            </button>
            <button class="flex bg-white text-black font-bold py-2 px-3 focus:outline-none slider-home-next">
                <i class="mdi mdi-arrow-right text-2xl leading-none"></i>
            </button>
        </div>
    </div>


    <div class="container mx-auto flex ">
        <div class="w-1/2 flex flex-col justify-center h-auto p-20">
            <p class="text-4xl text-black-lighter_title">Учебный Комплекс</p>
            <p class="text-lg text-gray-lighter">Здравствуйте, дорогие родители, так как сейчас много частных и
                государственных детских садов, когда речь
                идет о том здравствуйте, дорогие родители, так как сейчас много частных и государственных детских садов,
                когда речь идет о том здравствуйте, дорогие родители, так как сейчас много частных и государственных
                детских садов, когда речь идет о том здравствуйте, дорогие родители, так как сейчас много частных и
                государственных детских садов, когда речь идет о том
            </p>
            <a class="flex items-center justify-end mt-24 text-black-lighter_title" href="javascript:void(0)">Подробнее
                <i class="mdi mdi-arrow-right text-2xl leading-none ml-2"></i>
            </a>
        </div>
        <div class="w-1/2 p-24">
            <div class="">
                <img class="shadow-2xl w-full object-center object-cover" src="{{ asset('img/site/complex.jpg') }}"
                     alt="">
            </div>
        </div>
    </div>

    <div class="">
        <div class="container mx-auto py-10">
            <p class="text-4xl text-blue font-bold underline">Наши Направления</p>
        </div>
        <div class="flex items-center justify-between">
            <div class="training-complex">
                <div class="img-parent">
                    <img class="rounded-full animate-training" data-animate=".animate-circle-training"
                         src="{{ asset('img/site/uchobni.jpg') }}" alt="">
                    <div class="animate-circle-training animate absolute">
                        @for($i=0;$i<10;$i++)
                            <span class="elements">
                               <div class="w-20 h-20 bg-blue rounded-full flex justify-center items-center">
                                   <span>{{ $i }}</span>
                               </div>
                           </span>
                        @endfor
                    </div>
                    <p class="absolute position-center-custom text-white text-6xl w-full text-center">
                        Учебный комплекс
                    </p>
                </div>
            </div>
            <div class="sport-complex">
                <div class="img-parent">
                    <img class="rounded-full animate-sport" data-animate=".animate-circle-sport"
                         src="{{ asset('img/site/sport.jpg') }}" alt="">
                    <div class="animate-circle-sport animate absolute">
                        @for($i=0;$i<10;$i++)
                            <span class="elements">
                               <div class="w-20 h-20 bg-blue rounded-full flex justify-center items-center">
                                   <span>{{ $i }}</span>
                               </div>
                           </span>
                        @endfor
                    </div>
                    <p class="absolute position-center-custom text-white text-5xl w-full text-center">
                        Спорткомплекс
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-10">
        <p class="text-4xl text-blue font-bold underline">Услуги школы</p>
    </div>
    <div class="container mx-auto">
        <div class="-mx-2">
            <div class="swiper-container slider-school-services pb-12">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="flex flex-wrap">
                            @for($i=0;$i<8;$i++)
                                <div class="w-1/4 rounded p-2">
                                    <div class="relative h-full">
                                        <img class="w-full h-full object-cover"
                                             src="{{ asset('img/site/'.$i.'.jpg') }}"
                                             alt="">
                                        <div class="absolute  left-0 bottom-0 p-5 bg-gray-linear-gradient w-full">
                                            <a class="text-lg text-white" href="javascript:void(0)"> Название
                                                Услуги</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-wrap">
                            @for($i=0;$i<8;$i++)
                                <div class="w-1/4 rounded p-2">
                                    <div class="relative h-full">
                                        <img class="w-full h-full object-cover"
                                             src="{{ asset('img/site/'.$i.'.jpg') }}"
                                             alt="">
                                        <div class="absolute  left-0 bottom-0 p-5 bg-gray-linear-gradient w-full">
                                            <a class="text-lg text-white" href="javascript:void(0)"> Название
                                                Услуги</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination swiper-school"></div>
            </div>

        </div>
    </div>
    <div class="container mx-auto py-4">
        <iframe height="558" class="w-full" src="https://www.youtube.com/embed/Gqq8ToIzN74" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
    <div class="container mx-auto py-10">
        <p class="text-4xl text-blue font-bold underline">Услуги спорткомплекса </p>
    </div>
    <div class="container mx-auto">
        <div class="-mx-2">
            <div class="swiper-container slider-school-services pb-12">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="flex flex-wrap">
                            @for($i=0;$i<8;$i++)
                                <div class="w-1/4 rounded p-2">
                                    <div class="relative h-full">
                                        <img class="w-full h-full object-cover"
                                             src="{{ asset('img/site/'.$i.'.jpg') }}"
                                             alt="">
                                        <div class="absolute  left-0 bottom-0 p-5 bg-gray-linear-gradient w-full">
                                            <a class="text-lg text-white" href="javascript:void(0)"> Название
                                                Услуги</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-wrap">
                            @for($i=0;$i<8;$i++)
                                <div class="w-1/4 rounded p-2">
                                    <div class="relative h-full">
                                        <img class="w-full h-full object-cover"
                                             src="{{ asset('img/site/'.$i.'.jpg') }}"
                                             alt="">
                                        <div class="absolute  left-0 bottom-0 p-5 bg-gray-linear-gradient w-full">
                                            <a class="text-lg text-white" href="javascript:void(0)"> Название
                                                Услуги</a>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination swiper-school"></div>
            </div>

        </div>
    </div>
    <div class="container mx-auto py-10">
        <p class="text-4xl text-blue font-bold underline">Новости учебно-спортивного комплекса</p>
    </div>
    <div class="container mx-auto">
        <div class="flex">
            <div class="w-9/12  py-5 px-20 border-2 border-border rounded-lg relative">
                <div class="swiper-container slider-new-sport-complex">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<16;$i++)
                            <div class="swiper-slide">
                                <a class="underline text-gray" href="javascript:void(0)">Название раздела </a>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="flex absolute inset-0 w-full h-full justify-between items-center px-5">
                    <div
                        class="flex rounded-full shadow-custom bg-white new-sport-complex-button-prev focus:outline-none p-1">
                        <i class="mdi mdi-arrow-left text-xl leading-none"></i>
                    </div>
                    <div
                        class="flex rounded-full shadow-custom bg-white new-sport-complex-button-next focus:outline-none p-1">
                        <i class="mdi mdi-arrow-right text-xl leading-none"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex -mx-3">
            @for($i=0;$i<3;$i++)
                <div class="w-1/3 p-3">
                    <div class="shadow-lg">
                        <div class="relative">
                            <img class="w-full object-cover" src="{{ asset('img/site/sport-news.jpg') }}" alt="">
                            <div class="absolute left-0 bottom-0 p-5 bg-black-linear-gradient w-full">
                                <p class="text-2xl text-white">Оглавление</p>
                            </div>
                        </div>
                        <div class="p-5 bg-white">
                            <p class="text-lg">Отбор высококвалифицированных педагогических
                                кадров для работы со школьниками.забота
                                о здоровье </p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="container mx-auto py-5">
        <div class="relative">
            <img class="w-full object-cover brightness-5" src="{{ asset('img/site/reports.jpg') }}" alt="">
            <div class="absolute z-10 w-full h-full inset-0">
                <div class="flex flex-column w-full h-full justify-center items-center">
                    <div class="w-3/5 bg-white p-5 relative flex flex-col items-center">
                        <p class="text-4xl text-blue text-center pb-3">Новостная рассылка</p>
                        <p class="text-lg w-9/12 text-center">Подпишитесь на наши новости, обновления и публикации с
                            помощью электронного адреса</p>
                        <div class="flex w-9/12 py-10">
                            <input class="flex-1 bg-body placeholder-gray-lighter p-3 mr-2" type="email" aria-label="Email" placeholder="Электронный адрес">
                            <button class="bg-blue hover:bg-blue text-white font-bold py-2 px-4">Подписаться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
