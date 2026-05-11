@extends( 'layouts/admin_layout' )
@section( 'content' )

<style>
	.cursor_prevent {
		pointer-events: none;
	}

</style>



<!-- 
1 => Directorate( admin )
2 => RSO
3 => Associate
4 => Recruitment Cell
	-->

<?php
$cursor_prevent = "cursor_prevent";
?>







<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<div class="row">
				<h4 class="col-md-10 mb-0">Dashboard</h4>
			</div>
		</div>
		



		<div class="row">
				<div class="col-md-3 {{$cursor_prevent}}">
					<a href="{{ route('direct_rect') }}" class="intentbtn bluecolor">
						<span class="intenticon">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 440 440" style="enable-background:new 0 0 440 440;" xml:space="preserve">
									<g id="_x33_3-Theatre_seating"> <path d="M197.919,231.654c-8.434,0-15.294,6.858-15.294,15.294v27.528h-8.252v-27.528c0-10.777,7.321-20.116,17.624-22.786V179.71 c0-8.595-6.991-15.591-15.585-15.591H112.92c-8.594,0-15.585,6.996-15.585,15.591v44.452c10.302,2.67,17.622,12.009,17.622,22.786 v27.528h-8.25v-27.528c0-8.436-6.86-15.294-15.295-15.294c-8.432,0-15.294,6.858-15.294,15.294v32.71 c0,8.432,6.863,15.296,15.294,15.296h44.238v16.682h-9.923c-0.894,0-1.716,0.489-2.146,1.274l-10.066,18.399 c-0.411,0.753-0.396,1.677,0.041,2.417c0.439,0.74,1.246,1.198,2.105,1.198h58.083c1.322-0.03,2.388-1.115,2.388-2.445 c0-0.48-0.14-0.942-0.401-1.341l-0.081-0.13l-9.899-18.099c-0.43-0.785-1.253-1.274-2.146-1.274h-9.923v-16.682h44.237 c8.433,0,15.296-6.864,15.296-15.296v-32.71C213.215,238.513,206.352,231.654,197.919,231.654z" /> <path d="M348.588,231.654c-8.435,0-15.293,6.858-15.293,15.294v27.528h-8.252v-27.528c0-10.777,7.319-20.116,17.622-22.786V179.71 c0-8.595-6.991-15.591-15.586-15.591h-63.49c-8.596,0-15.586,6.996-15.586,15.591v44.452c10.303,2.67,17.624,12.009,17.624,22.786 v27.528h-8.251v-27.528c0-8.436-6.86-15.294-15.294-15.294c-8.434,0-15.297,6.858-15.297,15.294v32.71 c0,8.432,6.863,15.296,15.297,15.296h44.236v16.682h-9.923c-0.893,0-1.716,0.489-2.145,1.274l-10.066,18.399 c-0.411,0.753-0.395,1.677,0.043,2.417c0.436,0.74,1.245,1.198,2.104,1.198h58.081c1.322-0.03,2.388-1.115,2.388-2.445 c0-0.48-0.14-0.942-0.399-1.341l-0.082-0.13l-9.9-18.099c-0.429-0.785-1.251-1.274-2.145-1.274h-9.923v-16.682h44.237 c8.432,0,15.295-6.864,15.295-15.296v-32.71C363.884,238.513,357.02,231.654,348.588,231.654z" /> <path d="M89.592,179.71c0-12.864,10.465-23.328,23.328-23.328h2.96v-35.72c0-8.597-6.991-15.587-15.586-15.587H36.804 c-8.594,0-15.588,6.99-15.588,15.587v44.451C31.521,167.782,38.84,177.12,38.84,187.9v27.528h-8.251V187.9 c0-8.435-6.859-15.297-15.294-15.297C6.863,172.604,0,179.466,0,187.9v32.71c0,8.435,6.863,15.294,15.294,15.294h44.237v16.687 h-9.923c-0.893,0-1.716,0.484-2.145,1.27l-10.066,18.401c-0.412,0.75-0.396,1.682,0.042,2.416c0.438,0.74,1.244,1.202,2.104,1.202 h28.832v-28.933c0-12.092,9.364-22.032,21.217-22.965V179.71z" /> <path d="M240.263,179.71c0-12.864,10.464-23.328,23.327-23.328h2.96v-35.72c0-8.597-6.992-15.587-15.586-15.587h-63.491 c-8.594,0-15.587,6.99-15.587,15.587v35.72h4.525c12.862,0,23.327,10.464,23.327,23.328v44.273 c9.617,0.756,17.594,7.442,20.263,16.395c2.669-8.952,10.645-15.639,20.263-16.395V179.71z" /> <path d="M424.706,172.604c-8.436,0-15.294,6.862-15.294,15.297v27.528h-8.251V187.9c0-10.78,7.318-20.118,17.623-22.787v-44.451 c0-8.597-6.993-15.587-15.587-15.587h-63.491c-8.595,0-15.586,6.99-15.586,15.587v35.72h2.959 c12.863,0,23.329,10.464,23.329,23.328v44.273c11.853,0.933,21.217,10.873,21.217,22.965v28.933h28.904 c1.323-0.034,2.388-1.117,2.388-2.449c0-0.476-0.139-0.942-0.399-1.34l-0.082-0.133l-9.9-18.098c-0.429-0.786-1.25-1.27-2.145-1.27 h-9.923v-16.687h44.238c8.432,0,15.294-6.859,15.294-15.294V187.9C440,179.466,433.137,172.604,424.706,172.604z" /> </g>
							</svg>
						</span>
						<span class="intentdata"><b class="intentno">@if(isset($direct)){{$direct[0]->total}}@endif</b>Direct Recruitment</span>
					</a>
				</div>
			<div class="col-md-3 {{$cursor_prevent}}">
				<a href="{{ route('financial_assis') }}" class="intentbtn pinkcolor">
                    <span class="intenticon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
							<g><path d="M98.925,91.96V94a6.92,6.92,0,0,0,13.84,0V91.96a6.92,6.92,0,1,0-13.84,0Zm10.34,0V94a3.42,3.42,0,0,1-6.84,0V91.96a3.42,3.42,0,1,1,6.84,0Z" /><path d="M22.155,85.039a6.929,6.929,0,0,0-6.92,6.921V94a6.92,6.92,0,0,0,13.84,0V91.96A6.928,6.928,0,0,0,22.155,85.039ZM25.575,94a3.42,3.42,0,0,1-6.84,0V91.96a3.42,3.42,0,1,1,6.84,0Z" /><path d="M64,81.213a8.443,8.443,0,0,0-8.433,8.433v2.632a8.433,8.433,0,0,0,16.866,0V89.646A8.443,8.443,0,0,0,64,81.213Zm4.933,11.065a4.933,4.933,0,1,1-9.866,0V89.646a4.933,4.933,0,0,1,9.866,0Z" /><path d="M126.25,16.747A1.749,1.749,0,0,0,128,15V1.747A1.749,1.749,0,0,0,126.25,0H1.75A1.749,1.749,0,0,0,0,1.747V15a1.749,1.749,0,0,0,1.75,1.75h8.844v64.23a22.145,22.145,0,1,0,28.894,32.657,28.1,28.1,0,0,0,49.022,0,22.145,22.145,0,1,0,28.9-32.661V16.747ZM3.5,3.5h121v9.75H3.5ZM10.133,114.11a7.026,7.026,0,0,1,7.009-6.725H27.169a7.025,7.025,0,0,1,7.009,6.741,18.609,18.609,0,0,1-24.045-.016Zm26.976-3.125a10.533,10.533,0,0,0-9.94-7.1H17.142A10.532,10.532,0,0,0,7.2,110.977,18.629,18.629,0,1,1,37.778,89.718a28.018,28.018,0,0,0,0,20.3Q37.457,110.515,37.109,110.985ZM47.93,118.5v-2.429a9.6,9.6,0,0,1,9.589-9.59H70.48a9.6,9.6,0,0,1,9.59,9.59V118.5a24.551,24.551,0,0,1-32.14,0Zm35.579-3.634A13.1,13.1,0,0,0,70.48,102.984H57.519a13.1,13.1,0,0,0-13.028,11.885,24.625,24.625,0,1,1,39.018,0Zm10.313-.737a7.024,7.024,0,0,1,7.009-6.747h10.027a7.026,7.026,0,0,1,7.009,6.725,18.619,18.619,0,0,1-24.045.022ZM124.5,99.868a18.535,18.535,0,0,1-3.7,11.109,10.532,10.532,0,0,0-9.938-7.092H100.831a10.533,10.533,0,0,0-9.94,7.1q-.348-.469-.669-.965a28.021,28.021,0,0,0,0-20.3A18.638,18.638,0,0,1,124.5,99.868Zm-10.594-20.63a22.094,22.094,0,0,0-25.4,6.863,28.1,28.1,0,0,0-49.019,0,22.1,22.1,0,0,0-25.4-6.858V16.747h99.812Z" /><path d="M20.344,33.748h87.312a1.749,1.749,0,0,0,1.75-1.75V24a1.749,1.749,0,0,0-1.75-1.75H20.344A1.749,1.749,0,0,0,18.594,24v8A1.749,1.749,0,0,0,20.344,33.748Zm1.75-8h83.812v4.5H22.094Z" /><path d="M20.344,50.314h87.312a1.75,1.75,0,0,0,1.75-1.75v-8a1.749,1.749,0,0,0-1.75-1.75H20.344a1.749,1.749,0,0,0-1.75,1.75v8A1.75,1.75,0,0,0,20.344,50.314Zm1.75-8h83.812v4.5H22.094Z" /><path d="M103.344,55.379H24.656a1.749,1.749,0,0,0-1.75,1.75v8a1.749,1.749,0,0,0,1.75,1.75h78.688a1.75,1.75,0,0,0,1.75-1.75v-8A1.75,1.75,0,0,0,103.344,55.379Zm-1.75,8H26.406v-4.5h75.188Z" /></g></svg>
					</span>
					<span class="intentdata"><b class="intentno">@if(isset($financial)){{$financial[0]->total}}@endif</b>Financial Assistance</span>
				</a>
			</div>
			<div class="col-md-3 {{$cursor_prevent}}">
				<a href="{{ route('monthly_pension') }}" class="intentbtn yellowcolor">
                    <span class="intenticon">
                        <svg  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M458.666,42.67h-53.33V32c0-17.645-14.356-32-32.002-32c-17.644,0-31.999,14.355-31.999,32v10.67H170.664V32 c0-17.645-14.354-32-31.999-32s-32,14.355-32,32v10.67H53.334c-5.892,0-10.667,4.776-10.667,10.667v447.995 c0,5.89,4.776,10.667,10.667,10.667h405.332c5.891,0,10.667-4.778,10.667-10.667V53.337 C469.333,47.446,464.557,42.67,458.666,42.67z M362.67,53.337V32c0-5.882,4.784-10.665,10.666-10.665 c5.881,0,10.665,4.783,10.665,10.665v21.337V74.67c0,0.735-0.075,1.452-0.218,2.146c-0.996,4.855-5.303,8.517-10.45,8.517 c-5.881,0-10.664-4.783-10.664-10.663V53.337z M128,53.337V32c0-5.882,4.783-10.665,10.667-10.665 c5.88,0,10.662,4.783,10.662,10.665v21.337V74.67c0,1.469-0.299,2.871-0.838,4.146c-1.621,3.825-5.415,6.517-9.826,6.517 C132.783,85.333,128,80.55,128,74.67V53.337z M64.001,64.005h42.663V74.67c0,2.756,0.35,5.434,1.009,7.988 c3.557,13.791,16.103,24.01,30.991,24.01h0.002c17.643,0,31.997-14.355,31.997-31.998V64.005h170.67V74.67 c0,17.643,14.355,31.998,32.001,31.998c17.645,0,32-14.355,32-31.998V64.005h42.662v63.994H64.001V64.005z M447.999,490.665 H64.001v0v-21.328h68.657c5.891,0,10.667-4.778,10.667-10.667c0-5.892-4.777-10.667-10.667-10.667H64.001V149.334h383.997 V490.665z"></path> <path d="M141.432,249.712c1.736,0,4.342-0.868,6.37-2.896l10.134-12.742v160.764c0,6.661,7.528,10.134,15.347,10.134 c7.531,0,15.349-3.473,15.349-10.134v-191.41c-0.001-6.371-7.24-10.134-13.612-10.134c-3.474,0-5.792,1.159-7.818,3.185 l-30.115,28.907c-3.765,2.608-6.08,7.53-6.08,11.874C131.007,243.34,135.349,249.712,141.432,249.712z"></path> <path d="M316.134,406.711c36.486,0,64.866-16.506,64.866-59.652v-3.475c-0.001-29.827-13.321-46.913-33.303-54.154 c16.216-6.082,27.221-20.556,27.221-45.174c0-37.065-24.904-50.962-58.784-50.962c-33.881,0-58.784,13.896-58.784,50.962 c0,24.618,11.005,39.092,26.931,45.174c-19.98,7.24-33.301,24.327-33.301,54.154v3.475 C250.98,390.206,279.647,406.711,316.134,406.711z M316.134,218.774c18.245,0,28.959,8.398,28.959,28.958 c0,20.85-10.714,29.248-28.959,29.248c-18.242,0-28.958-8.398-28.958-29.248C287.175,227.173,297.892,218.774,316.134,218.774z M281.674,338.66c0-24.904,13.032-36.197,34.46-36.197c21.428,0,34.17,11.293,34.17,36.197v5.213 c0,25.191-12.451,37.353-34.17,37.353c-21.139,0-34.46-11.58-34.46-37.353V338.66z"></path> <path d="M163.556,448.006h-0.254c-5.892,0-10.667,4.776-10.667,10.667c0,5.889,4.776,10.667,10.667,10.667h0.254 c5.892,0,10.667-4.778,10.667-10.667C174.224,452.781,169.448,448.006,163.556,448.006z"></path> </g> </g> </g> </g></svg>
                    </span>
					<span class="intentdata"><b class="intentno"> @if(isset($monthly)){{$monthly[0]->total}}@endif</b> Monthly Pension</span>
				</a>
			</div>


			<div class="col-md-3 {{$cursor_prevent}}"> 
				<a href="{{ route('laxman') }}" class="intentbtn greencolor"> 
					<span class="intenticon">
						<svg fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="Layer 2"> <g data-name="award"> <rect width="24" height="24" opacity="0"></rect> <path d="M19 20.75l-2.31-9A5.94 5.94 0 0 0 18 8 6 6 0 0 0 6 8a5.94 5.94 0 0 0 1.34 3.77L5 20.75a1 1 0 0 0 1.48 1.11l5.33-3.13 5.68 3.14A.91.91 0 0 0 18 22a1 1 0 0 0 1-1.25zM12 4a4 4 0 1 1-4 4 4 4 0 0 1 4-4z"></path> </g> </g> </g></svg>
					</span>
					<span class="intentdata"> <b class="intentno">@if(isset($laxman)){{$laxman[0]->total}}@endif</b> Nomination for Laxman Award</span>
				</a>
			</div>

			<div class="col-md-3 {{$cursor_prevent}}">
				<a href="{{ route('laxmibai') }}" class="intentbtn box5color">
                    <span class="intenticon">
                        <svg fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="Layer 2"> <g data-name="award"> <rect width="24" height="24" opacity="0"></rect> <path d="M19 20.75l-2.31-9A5.94 5.94 0 0 0 18 8 6 6 0 0 0 6 8a5.94 5.94 0 0 0 1.34 3.77L5 20.75a1 1 0 0 0 1.48 1.11l5.33-3.13 5.68 3.14A.91.91 0 0 0 18 22a1 1 0 0 0 1-1.25zM12 4a4 4 0 1 1-4 4 4 4 0 0 1 4-4z"></path> </g> </g> </g></svg>
                    </span> 
					<span class="intentdata"> <b class="intentno">@if(isset($ranilaxmibai)){{$ranilaxmibai[0]->total}}@endif</b> Nomination for Rani Laxmibai Award</span>
				</a>
			</div>
			<div class="col-md-3 {{$cursor_prevent}}">
				<a href="{{ route('award') }}" class="intentbtn box6color">
					<span class="intenticon">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 493.133 493.133" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M416.588,104.553c-2.867-2.858-7.512-2.858-10.379,0.008l-1.065,1.066l-4.126-4.125c-1.184-1.187-2.785-1.858-4.468-1.858 c-1.339,0-2.565,0.526-3.631,1.297c1.208,6.148,0.647,12.651-1.914,18.819c-0.188,0.451-14.62,31.573-14.62,31.573 c0.219,0.02,0.418,0.128,0.641,0.128c1.953,0,3.81-0.77,5.189-2.147l34.389-34.366c1.377-1.377,2.147-3.25,2.147-5.198 C418.75,107.805,417.965,105.94,416.588,104.553z"></path> <path d="M358.735,53.324c-0.488-0.646-0.426-1.555,0.147-2.127l4.513-4.514c6.711-6.704,8.456-16.939,4.357-25.477L361.375,7.88 c-1.877-3.913-6.578-6.606-9.822-7.457c-1.199-0.314-6.41-1.826-11.914,3.74c-2.297,2.324-9.24,9.244-9.24,9.244 c-0.556,0.557-1.477,0.489-1.947-0.143l-0.054-0.074c-1.085-1.463-2.47-2.711-4.12-3.481c-4.322-2.014-9.177-1.024-12.315,2.119 l-32.935,32.948c-2.209,2.21-3.363,5.269-3.141,8.384c0.209,3.116,1.779,5.992,4.263,7.873l0.015,0.012 c0.785,0.6,0.86,1.753,0.162,2.451l-8.939,8.941c-3.107,3.084-4.532,7.505-3.796,11.829c0.736,4.309,3.523,8.009,7.464,9.907 l13.343,6.383c2.996,1.442,6.343,2.203,9.659,2.203c5.975,0,11.581-2.322,15.825-6.544l4.522-4.523 c0.573-0.574,1.482-0.637,2.129-0.148l7.572,5.721c0.284,0.215,0.631,0.268,0.923,0.463l2.073-4.428 c6.346-13.552,20.787-20.659,34.834-18.425c0.897,0.143,1.738-0.518,1.837-1.421c0.478-4.354-0.487-8.825-3.308-12.55 L358.735,53.324z M308.173,84.522l-2.987,2.989c-2.979,2.979-7.656,3.804-11.469,1.954l-12.713-6.117 c-1.007-0.484-1.236-1.816-0.448-2.609l10.013-10.073c0.572-0.576,1.482-0.641,2.131-0.151l15.304,11.563 C308.79,82.672,308.87,83.825,308.173,84.522z M354.696,37.976l-2.984,2.987c-0.697,0.698-1.85,0.618-2.445-0.169l-11.564-15.3 c-0.488-0.646-0.426-1.554,0.146-2.127c0,0,9.518-9.527,10.437-10.469c0.763-0.781,1.372-0.359,1.685,0.25 c0.255,0.497,6.697,13.383,6.697,13.383C358.508,30.368,357.723,34.965,354.696,37.976z"></path> <path d="M255.352,183.663l-27.5-0.145l-27.605-0.146l9.441,26.194l12.924,35.855c1.691-0.387,3.434-0.634,5.24-0.634 c1.807,0,3.549,0.247,5.24,0.634l12.924-35.855L255.352,183.663z"></path> <path d="M369.512,88.648c-10.299-4.829-22.473-0.384-27.262,9.867l-24.812,52.971c-3.38,7.232-9.241,13.046-16.514,16.386 l-5.134,2.351l-26.98,12.354l-24.77,68.733c4.528,4.3,7.389,10.336,7.389,17.057c0,12.999-10.57,23.578-23.577,23.578 c-13.006,0-23.579-10.579-23.579-23.578c0-6.722,2.862-12.758,7.392-17.058l-24.277-67.364l-0.493-1.368l-32.114-14.704 c-7.271-3.34-13.135-9.154-16.53-16.402l-24.796-52.954c-4.789-10.251-16.994-14.696-27.262-9.867 c-10.251,4.798-14.672,17.003-9.867,27.263l24.779,52.938c7.496,16.026,20.487,28.92,36.602,36.296l39.867,18.12v248.871 c0,11.597,9.401,20.998,20.999,20.998c11.597,0,20.998-9.401,20.998-20.998V346.637h16.596v125.491 c0,11.596,9.402,20.999,20.998,20.999c11.582,0,20.983-9.395,20.983-20.983V223.26L318,205.145 c16.113-7.376,29.103-20.271,36.584-36.28l24.795-52.954C384.184,105.651,379.764,93.446,369.512,88.648z"></path> <path d="M227.868,170.305c25.229,0,45.684-20.461,45.684-45.697c0-25.245-20.455-45.706-45.684-45.706 c-25.26,0-45.714,20.461-45.714,45.706C182.154,149.844,202.608,170.305,227.868,170.305z"></path> <path d="M212.474,268.366c0,8.49,6.89,15.377,15.378,15.377c8.489,0,15.377-6.887,15.377-15.377 c0-8.489-6.888-15.377-15.377-15.377C219.364,252.988,212.474,259.877,212.474,268.366z"></path> </g> </g></svg>
					</span>
					<span class="intentdata"><b class="intentno">@if(isset($position)){{$position[0]->total}}@endif</b>Nomination for Prize Money</span>
				</a>
			</div>
			

		</div>
		<div class="table-responsive">

			<table  id="dataTable" class="table table-striped table-hover table-bordered">

				<thead>
					<tr>
						<!-- <th align="center">S.No.</th> -->
						<th>Module Name</th>
						<th align="center">Total Application Received</th>
						<th align="center">Applications Forwarded</th>
						<th align="center">Applications Pending</th>
						<th align="center">Applications Accepted</th>
						<th align="center">Applications Rejected</th>
						<th align="center">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($direct as $key=>$list)
						<!-- <td align="center">1</td> -->
						<td>Direct Recruitment </td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
					<tr>
						@foreach($financial as $key=>$list)
						<!-- <td align="center">2</td> -->
						<td>Financial Assistance</td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
					<tr>
						@foreach($monthly as $key=>$list)
						<!-- <td align="center">3</td> -->
						<td>Monthly Pension</td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
					<tr>
						@foreach($laxman as $key=>$list)
						<!-- <td align="center">4</td> -->
						<td>Nomination for Laxman Award</td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
					<tr>
						@foreach($ranilaxmibai as $key=>$list)
						<!-- <td align="center">5</td> -->
						<td>Nomination for Rani Laxmibai Award</td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
					<tr>
						@foreach($position as $key=>$list)
						<!-- <td align="center">6</td> -->
						<td>Nomination for Prize Money</td>
						<td align="center">{{$list->total}}</td>
						<td align="center">{{$list->total_app_forward}}</td>
						<td align="center">{{$list->total_pending}}</td>
						<td align="center">{{$list->total_accepted}}</td>
						<td align="center">{{$list->total_rejected}}</td>
						<td align="center">&nbsp;</td>
						@endforeach
					</tr>
				</tbody>
			</table>



		</div>
	




	</div>
</div>




@endsection

@push( 'custom-scripts' )
	<script type="text/javascript">
		$( function () {
			var table = $( '.yajra-datatable' ).DataTable( {
				processing: true,
				serverSide: true,
				ajax: "{{ route('projectlist') }}",
				columns: [ {
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				}, {
					data: 'fullname',
					name: 'fullname'
				}, {
					data: 'project_id',
					name: 'project_id'
				}, {
					data: 'project_name',
					name: 'project_name'
				}, {
					data: 'application_date',
					name: 'application_date'
				}, {
					data: 'current_status',
					name: 'current_status',
					orderable: false,
					searchable: false
				}, {
					data: 'view',
					name: 'view',
					orderable: false,
					searchable: false
				}, ]
			} );
		} );
	</script>
@endpush
