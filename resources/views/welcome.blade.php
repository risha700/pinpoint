@extends('layouts.app')
@section('hero')
    <div>
        <div class="uk-height-large uk-height-viewport uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top"
             style="background:url('/topography.svg') repeat-x  top 300px left 100px, linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);">
            <div class="uk-container uk-container-expand uk-width-1-1 uk-margin-auto-top uk-margin-auto-bottom">


                <div class="uk-child-width-1-2@m uk-grid-match uk-text-center" uk-grid>
                    <!-- right side-->

                    <div>
                        <div uk-scrollspy="cls: uk-animation-scale-up; delay: 500;">
                            <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: 7:3; animation: push; autoplay: true; autoplay-interval:2000;">

                                <ul class="uk-slideshow-items">
                                    <li>
                                        <img src="https://placeimg.com/640/480/tech" alt="" uk-cover>
                                    </li>
                                    <li>
                                        <img src="https://placeimg.com/640/480/people" alt="" uk-cover>
                                    </li>
                                    <li>
                                        <img src="https://placeimg.com/640/480/tech" alt="" uk-cover>
                                    </li>
                                </ul>

                                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                            </div>
                        </div>

                    </div>
                    <!-- right side-->
                    <div>
                        <div>
                            <div class="" uk-scrollspy="cls: uk-animation-slide-left; delay: 500;">
                                <h3 class="uk-text-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                            </div>
                        </div>
                        <div>
                            <div class="" uk-scrollspy="cls: uk-animation-slide-right; delay: 500;">
                                <button class="uk-button uk-button-success uk-border-rounded uk-box-shadow-hover-xlarge">Shop now</button>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <img id="bottom-curve" src="/img/page-breaks/curve-bottom.svg" svg/>
    </div>
@endsection
@section('content')

    <div class="uk-container uk-container-expand uk-width-1-1 uk-margin-auto-top uk-margin-auto-bottom " >

        <!-- services-->
        <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match uk-margin-top uk-margin-bottom uk-text-center" uk-grid>
            <div>
                <div class="uk-card uk-card-hover uk-card-body hover-style">
                    <span uk-icon="icon: git-fork; ratio: 3.5"></span>

                    <div class="uk-card-title">Service</div>


                </div>
            </div>
            <div>
                <div class="uk-card uk-card-hover uk-card-body hover-style">
                    <span uk-icon="icon: check; ratio: 3.5"></span>
                    <div class="uk-card-title">Service</div>


                </div>
            </div>
            <div>
                <div class="uk-card uk-card-hover uk-card-body hover-style">
                    <span uk-icon="icon: check; ratio: 3.5"></span>
                    <div class="uk-card-title">Service</div>


                </div>
            </div>
        </div>




        <!-- cards-->

        <div>
            <div class="uk-child-width-1-2@m uk-grid-match uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-left; delay: 100;">
                        <h3 class="uk-card-title">Left</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-right; delay: 100;">
                        <h3 class="uk-card-title">Right</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="uk-card uk-card-default uk-card-body uk-margin uk-margin-top" uk-scrollspy="cls: uk-animation-slide-bottom; delay: 150;">
                    <h3 class="uk-card-title">Right</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>


    </div>
    <!-- paralax-->

    <div class="uk-height-large uk-background-cover uk-light uk-flex" uk-parallax="bgy: -200"
         style="background: url('/circuit-board.svg'),linear-gradient(to left top, #042e6d, #002754, #021e3c, #091524, #05070a);">
        <img id="top-curve" src="/img/page-breaks/curve-top.svg" svg/>

        <div class="uk-container uk-container-expand uk-width-1-1 uk-margin-auto-top uk-margin-auto-bottom">
            <div class="uk-child-width-1-2@m uk-grid-match uk-text-center" uk-grid>
                <div>
                    <div class="uk-card uk-card-body uk-background-blend-lighten">

                        <form class="uk-form-stacked ">

                            <div class="uk-margin">
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                                    <input class="uk-border-rounded uk-input" type="text">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="uk-inline">
                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                    <input class="uk-border-rounded uk-input" type="text">
                                </div>
                            </div>

                        </form>



                    </div>
                </div>
                <!-- Right Side-->

                <div>

                    <div class="uk-card uk-card-default" style="background: url('/circuit-board.svg') center center #fff;">
                        <div class="uk-card-body">

                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>


                </div>

            </div>


        </div>

    </div>

    <!-- card slider -->

    <div uk-slider="center: true">

        <div class="uk-position-relative uk-visible-toggle uk-light">

            <ul class="uk-slider-items uk-child-width-1-2@s uk-grid">
                <li>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="https://placeimg.com/640/480/nature" alt="">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="https://placeimg.com/640/480/tech" alt="">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="https://placeimg.com/640/480/tech/sepia" alt="">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="https://placeimg.com/640/480/any" alt="">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top">
                            <img src="https://placeimg.com/640/480/any" alt="">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title">Headline</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        </div>
                    </div>
                </li>
            </ul>

            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

        </div>

        <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

    </div>



    switcher test

    <div class="uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top uk-padding-large uk-margin-bottom"
         style="background:linear-gradient(to right top, #8575AA, #5B7BB5, #0081B5, #0084A7, #00858D,#00836A);">

        <div class="uk-width-1-1 uk-text-center">



            <div uk-switcher="animation: uk-animation-fade" class="uk-margin-large-top uk-padding-large straight-line">
                <button class="uk-button uk-button-primary  uk-border-rounded" type="button"><span uk-icon="icon: check;ratio:3.5;"></span></button>
                <v-btn class="dashed" outline fab >
                    <v-icon >book</v-icon>
                </v-btn>

                <v-btn class="dashed " fab outline>
                    <v-icon >cached</v-icon>
                </v-btn>


                <v-btn class="dashed" fab outline>
                    <v-icon dark>settings</v-icon>
                </v-btn>
            </div>

            <ul class="uk-switcher uk-margin ">

                <li>
                    <div class="uk-child-width-1-2@s uk-text-center uk-margin-large-top" uk-grid>
                        <div>
                            <img src="https://placeimg.com/640/480/tech/sepia" svg width="200px"/>
                        </div>
                        <div class="uk-flex uk-flex-middle uk-padding-large">
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>

                </li>




                <li>
                    <div class="uk-child-width-1-2@s uk-text-center uk-margin-large-top" uk-grid>
                        <div>
                            <img src="https://placeimg.com/640/480/tech/sepia" svg width="200px"/>
                        </div>
                        <div class="uk-flex uk-flex-middle uk-padding-large">
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>

                </li>
                <li>
                    <div class="uk-child-width-1-2@s uk-child-width-1-@xs uk-text-center uk-margin-large-top" uk-grid>
                        <div>
                            <img src="https://placeimg.com/640/480/tech/sepia" svg width="200px"/>
                        </div>
                        <div class="uk-flex uk-flex-middle uk-padding-large">
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </div>



@endsection


