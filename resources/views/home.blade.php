@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 intro_col">
                    <div class="intro_content">
                        <div class="section_title_container">
                            <div class="section_title"><h6 align="center" class="h6-top-style">Adopt a Healthcare
                                    Worker, <br>Help a Neighbor, Share What You Can</h6><br>
                                <h6 align="center" class="h6-mid-style">Remember to maintain </h6>
                                <h6 align="center" class="h6-mid-style">"Physical Distance" but remain "Social"</h6>
{{--                                <h6 align="center" class="h6-mid-style">but remain "Social"</h6>--}}
                            </div>
                        </div>
                        <div class="home-milestones-mc milestones">
                            <div class="row milestones_row">
                                <div class="col-md-4 offset-md-4 mb-md-3 milestone_col">
                                    <div class="milestone">
                                        <form method="get" action="{{route('give.index')}}">
                                            <button class="button button_1 intro_button trans_200">What can you Give?
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-4 offset-md-4 mb-md-3  milestone_col">
                                    <div class="milestone">
                                        <form method="get" action="{{route('need.index')}}">
                                            <button class="button button_1 intro_button trans_200">What do you Need?
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h6 align="center" class="h6-mid-style" style="font-size: 17px;margin-top:15px;font-weight: 500">
                                        Share Stories of "Random Acts of Kindness" below:
                                    </h6></div>

                                <div class="col-md-4 offset-md-4 mb-3  milestone_col">
                                    <div class="milestone">
                                        <form method="get" action="{{route('hope.index')}}">
                                            <button class="button button_1 intro_button trans_200">Have some Hope to
                                                Share?
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h6 align="center" class="h6-bottom-style">Offer what you can GIVE, ask for what you NEED, and</h6>
{{--                                    <h6 align="center" class="h6-bottom-style">ask for what you NEED, and</h6>--}}
                                    <h6 align="center" class="h6-bottom-style">share HOPEful stories of "Random Acts of
                                        Kindness".</h6>
                                    <h6 align="center" class="h6-bottom-style">Please follow your local health
                                        organizations recommendations.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
