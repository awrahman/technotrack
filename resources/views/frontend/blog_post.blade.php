@extends('frontend.layout.app3')
@section('title',$post->blog_title)
@push('css')
@endpush
@section('content')

<!--/blog-section-->
	<section class="w3l-blog-post-main">
		<!--/blog-content-->
		<div class="blog-content-inf py-5">
			<div class="container py-lg-4">
				<!--/blog-grids-->
				<div class="abodedeskhny-blog-grids row">

					<div class="col-lg-10 blog-left-view mx-auto">

						<!--/single-post-->
						<div class="blog-posthny-info sing-abodedesk-page">
							<div class="single-post-image mb-4">
								<div class="post-content">
									<span class="sub-title">TechnoTrack</span>
									<h4 class="text-head-text-9 my-2">{{$post->blog_title}}</h4>
								</div>
								<ul class="blog-author-date d-flex align-items-center mb-4">

									<li>By <a href="#URL">{{$author->name}}</a></li>
									<li>{{date("F j, Y",strtotime($post->created_at))}}</li>
								</ul>
								<div class="single-page-img"><img src="{{asset('storage/app/public/blogs/'.$post->blog_image)}}" alt="" /></div>
							</div>

							<div class="single-post-content">
								<p class="mb-4">{{$post->blog_content}}</p>
								{{--<blockquote class="blockquote my-5">
									Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio
									consectetur.Ea
									consequuntur illum facere aperiam sequi optio consectetur adipisicing elitFuga,
									suscipit
									totam
									animi consequatur saepe blanditiis.
									<footer class="blockquote-footer mt-3">
										Mickel Zaman
										<cite title="Source Title pl-2">City Name</cite>
									</footer>
								</blockquote>--}}

								<footer class="blog-post-details-footer">
									<div class="row mx-lg-0">
										<div class="col-md-6 text-center text-sm-left">
											<div class="post-tags"><span>Tags: </span>
											    @php ($tags = explode(',',$post->blog_tags))
											    @switch(count($tags))
											        @case(1)
											            <a href="{{route('search/tag',$tags[0])}}">{{$tags[0]}}</a>
											            @break
											        @case(2)
											            <a href="{{route('search/tag',$tags[0])}}">{{$tags[0]}},</a>
											            <a href="{{route('search/tag',$tags[1])}}">{{$tags[1]}}</a>
											            @break
											        @default
											            <a href="{{route('search/tag',$tags[0])}}">{{$tags[0]}},</a>
											            <a href="{{route('search/tag',$tags[1])}}">{{$tags[1]}},</a>
											            <a href="{{route('search/tag',$tags[2])}}">{{$tags[2]}}</a>
											    @endswitch
									        </div>
										</div>
										<div class="col-md-6 text-center text-sm-right">
											<div class="share-icons mt-md-0 mt-3">
												<a href="#"><span class="fa fa-facebook"></span></a>
										        <a href="#"><span class="fa fa-twitter"></span></a>
											    <a href="#"><span class="fa fa-tumblr"></span></a>
											    <a href="#"><span class="fa fa-pinterest"></span></a>
											</div>
										</div>
									</div>
								</footer>


								<!--//author-card-->
								<div class="row author-card author-listhny my-lg-5 my-4">
									<div class="author-left col-sm-3 mb-sm-0 mb-4">
										<a href="#author">
											<img class="img-fluid" src="{{asset('public/assets/backend/img/avatar5.png')}}" alt=" ">
										</a>
									</div>
									<div class="author-right col-sm-9 position-relative">

										<h4><a href="#author" class="title-team-28">{{$author->name}}</a></h4>
										<p class="para-team mb-0">{{$author->email}}</p>
										<p class="para-team mb-0">+88{{$author->phone}}</p>
										<div class="share-icons mt-4">
											<a href="#"><span class="fa fa-facebook"></span></a>
										</div>

									</div>
								</div>
								<!--//author-card-->

								<nav class="post-navigation row mt-5 mx-lg-0">
									<div class="post-prev col-md-6">
									    @if($post->id == 1)
									    @else
									    <span class="nav-title">
											Prev Post </span>
										<a href="{{route('post_id',$post->id-1)}}" rel="prev">
										    @php($prevPost = \App\Blog_post::where('id',$post->id-1)->first())
											<h5>{{str_limit($prevPost->blog_title,50)}}</h5>
										</a>
									    @endif
									</div>
									<div class="post-next col-md-6 text-md-right mt-md-0 mt-4">
									    @if($post->id == $post_count)
								        @else
										<span class="nav-title">
											Next Post </span>
										<a href="{{route('post_id',$post->id+1)}}" rel="next">
										    @php($nextPost = \App\Blog_post::where('id',$post->id+1)->first())
											<h5>{{str_limit($nextPost->blog_title,50)}}</h5>
										</a>
										@endif
									</div>
								</nav>
								@if(count($cmnt) > 0)
								<div class="comments mt-5">
									<h4 class="side-title ">Comments : {{count($cmnt)}}</h4>
									{{-- Comments loop --}}
									@foreach ($cmnt as $data)
									<div class="media">
										<div class="img-circle">
											<img src="{{asset('public/assets/backend/img/avatar5.png')}}" class="img-fluid" alt="...">
										</div>
										<div class="media-body">
											<div class="time-rply mb-2">
												<a href="#URL" class="name mt-0 mb-1 d-block">{{$data->name}}</a>
												{{date("F j, Y - h:i A",strtotime($data->created_at))}}
											</div>
											{{$data->comment}}
											{{--<div class="reply-last">
												<a href="#reply" class="reply">
													Reply</a>
											</div>
											<div class="media second mt-3 p-2">
												<a class="img-circle img-circle-sm" href="#">
													<img src="assets/images/c3.jpg" class="img-fluid" alt="...">
												</a>
												<div class="media-body">
													<div class="time-rply mb-2">
														<a href="#URL" class="name mt-0 mb-1 d-block">Marko Zaman</a>
														Apr 26, 2020 - 4:02 am


													</div>
													At vero eos et accusamus et iusto odio dignissimos ducimus qui
													blanditiis
													praesentium voluptatum deleniti atque corrupti quos dolores et quas
													molestias
													excepturi sint occaecati cupiditate non provident.
													<div class="reply-last">
														<a href="#reply" class="reply">
															Reply</a>
													</div>
												</div>
											</div>--}}
										</div>
									</div>
									@endforeach
									{{-- //Comments loop --}}
								</div>
								@else
								<div style="margin: 20px auto"><p><span class="sub-title">Be first to leave a comment.</span></p></div>
								@endif
								<div class="leave-comment-form mt-lg-5 mt-4" id="comment">
									<h4 class="side-title">Leave a Comment</h4>

									<form action="{{route('post_comment')}}" method="post">
                                        @csrf
										<div class="input-grids row">

											<div class="form-group col-lg-6">
											
												<input type="text" name="name" class="form-control"
													placeholder="Your Name" required="">
											</div>
											<div class="form-group col-lg-6">
												
												<input type="email" name="email" class="form-control"
													placeholder="Email" required="">
												<input type="hidden" name="id" value="{{$post->id}}" >
											</div>

										</div>
										<div class="form-group">
									
											<textarea name="comment" class="form-control" placeholder="Your Comment"
												required="" spellcheck="false"></textarea>
										</div>
										<div class="submit text-right mt-md-5 mt-4">
											<button class="btn btn-primary">Post Comment
											</button></div>
									</form>
								</div>
							</div>
						</div>

						<!--//single-post-->

					</div>
				</div>
			</div>
			<!--//blog-content-->
	</section>
	<!--//blog-section-->
@endsection
@push('js')
@endpush