@extends('frontend.layouts.master')

@section('content')
<!-- page title -->
<div class="page-title-area">
    <div class="container   ">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title text-center">
                    <h3>{{ $page_title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- maincontent area -->
<section class="main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-content">
                    <div class="welcome-content">
                        <div class="section-title">
                            <h2>About Us</h2>
                        </div>
                        <div class="section-content">
                            <div class="about-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita aperiam soluta quo maiores, id culpa a hic sequi voluptas assumenda eligendi. Ex itaque culpa eveniet voluptates consequatur odit. Distinctio reiciendis, cupiditate ut facilis amet, vero dolores, voluptate quisquam exercitationem quidem libero impedit corporis optio mollitia quos asperiores repellat doloremque inventore voluptatem a? Corrupti nostrum repellat repudiandae id laboriosam, commodi unde sunt. Libero corporis illum labore! Provident, beatae nisi tempora sunt numquam praesentium ad voluptates, aperiam odio deserunt, ut culpa ex voluptate at. Quae sequi, reiciendis asperiores explicabo dolorum, voluptatem quis tempora ducimus autem ipsa est consectetur qui dicta, culpa eveniet!</p>
                                <h3>Mission & Vission</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro deleniti debitis modi, possimus voluptatem quas saepe dolore odit quod alias voluptatum at iure repudiandae, soluta cum laboriosam nulla, quisquam animi. Ullam et accusantium consectetur voluptas ipsam? Similique unde fugiat pariatur assumenda harum error, veritatis obcaecati numquam adipisci! Modi consequatur molestiae repudiandae beatae optio impedit accusamus tenetur fuga excepturi. Illo laborum nihil, necessitatibus at itaque suscipit neque dicta aliquam dolor molestiae, voluptatem quia nam! Sequi asperiores reiciendis voluptates ratione vel, ab quo dolores quasi cumque laudantium, nesciunt vitae? Cumque voluptatibus asperiores deserunt, maxime aliquam ad qui maiores magnam sequi soluta doloremque itaque delectus laboriosam inventore molestiae id eveniet. Quae eligendi non, quasi, accusantium magni quos nobis incidunt ipsum vel molestias, fuga a saepe pariatur ad veniam! Quod cum, perspiciatis, impedit, a non sapiente ipsa ea vero assumenda hic cumque. Magnam porro earum labore vel, veniam atque modi voluptate eum iste! Tenetur, excepturi cum quis, aperiam totam aut aliquam ducimus, assumenda nihil qui numquam fugit eligendi inventore minima reiciendis magni dolorum recusandae non expedita repudiandae ipsa molestiae enim doloribus quas. Et, aut?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('frontend.partials._sidebar')
            </div>
        </div>
    </div>
</section>

@endsection