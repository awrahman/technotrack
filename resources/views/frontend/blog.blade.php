@extends('frontend.layout.app3')
@if(isset($tag))
@section('title',$tag)
@else
@section('title','TechnoBlog')
@endif
@push('css')
@endpush
@section('content')

		<!--/blog-section-->
	<section class="w3l-blog-post-main">
		<!--/blog-content-->
	<div class="blog-content-inf py-5">
		<div class="container py-lg-4">
			<div class="title-content text-center mb-lg-5 mb-4">
				<h6 class="sub-title">Technotrack Knowladgebase</h6>
				<h3 class="hny-title">Latest <span>Posts</span></h3>
			</div>
			
			@if(isset($tag))
		        <div><p>Search result for: <span class="sub-title">{{$tag}}</span></p></div>
		    @endif
			<!--/blog-grids-->
			<div class="abodedeskhny-blog-grids">
				<div class="blog-left-view">
					<div class="row abodedeskhny-grid-top">
				        @if(count($posts)>0)
				            @foreach($posts as $blogs)
						<!--/g1-->
						    <div class="col-lg-4 col-sm-6 abodedeskhny-grid-main">
							    <div class="abodedeskhny-grid-inf">
								    <a href="{{route('post_id',$blogs->id)}}"><img src="{{asset('storage/app/public/blogs/'.$blogs->blog_image)}}" class="img-fuild" alt=""></a>
									    <div class="abodedeskhny-content">
										    <div class="abodedeskhny-info">
											    <div class="abodedeskhny-admin-inf">
												    <div class="entry-meta">
												        @php($author = \App\User::where('id',$blogs->created_by)->first())
													    <a href="#author"><span class="fa fa-user"></span> {{$author->name}} </a>
													    
												    </div>
											    </div>
											    <a href="{{route('post_id',$blogs->id)}}" class="abodedeskhny-titlegulp-wrapper">
												    <h4 class="abodedeskhny-title">{{$blogs->blog_title}}</h4>
											    </a>
    										    <p class="card-text mb-0">{{str_limit($blogs->blog_content,200)}}<span class="p-ab">...</span></p>
											    <div class="read-arrow text-right mt-md-4 mt-3">
												    <a href="{{route('post_id',$blogs->id)}}"><span class="fa fa-arrow-right" aria-hidden="true"></span></a>
											    </div>
										    </div>
									    </div>
								    </div>
							    </div>
							<!--//g1-->
						    @endforeach
					    @else
						    <div style="margin: 10px auto;"><p>No posts yet</p></div>
						@endif
						</div>
					</div>
				</div>
				<!-- /pagination-->
				<div class="pagination p1">
					<ul>
						<a href="#">
							<li> <span class="fa fa-angle-double-left" aria-hidden="true"></span></li>
						</a>
						<a class="is-active" href="#">
							<li>1</li>
						</a>
						<a href="#">
							<li><span class="fa fa-angle-double-right" aria-hidden="true"></span></li>
						</a>
					</ul>
				</div>
				<!-- //pagination-->
			</div>
				<!--//blog-content-->
        </div>
    </section>
		<!--//blog-section-->
@endsection
@push('js')
@endpush