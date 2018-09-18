<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
        <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Ok4Homes Main pages"></i></li>
            <li class="active"><a href="{{URL('/o4k/dashboard')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <li><a href="{{URL('/o4k/countries')}}"><i class="icon-home4"></i> <span>Countries</span></a></li>
			<li class="">
				<a href="#" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Modules</span></a>
				<ul class="hidden-ul" style="display: none;">
					<li><a href="{{ URL::to('o4k/modules')}}" class="legitRipple">Admin Modules</a></li>
					<li><a href="{{ URL::to('o4k/modules/user')}}" class="legitRipple">User Modules</a></li>
				</ul>
			</li>
            
			<li><a href="{{URL('/o4k/permissions')}}"><i class="icon-home4"></i> <span>Permissions</span></a></li>
            <li><a href="{{URL('/o4k/roles')}}"><i class="icon-home4"></i> <span>Roles</span></a></li> 
			<li class="">
				<a href="#" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>User Access</span></a>
				<ul class="hidden-ul" style="display: none;">
				<li><a href="{{ URL::to('o4k/view')}}" class="legitRipple">Admin Users</a></li>
				<!--<li><a href="{{ URL::to('o4k/users')}}" class="legitRipple">Site Users</a></li>-->
				</ul>
			</li>
			<li class="">
				<a href="#" class="has-ul legitRipple"><i class="icon-city"></i> <span>Properties</span></a>
				<ul class="hidden-ul" style="display: none;">
				<li><a href="{{ URL::to('o4k/neighborhood')}}" class="legitRipple">Neighborhood</a></li>
				<li><a href="{{ URL::to('o4k/amenities')}}" class="legitRipple">Amenities</a></li>


				<!-- <li><a href="{{ URL::to('o4k/property_types')}}" class="legitRipple">Property Types</a></li> -->

				<li><a href="{{ URL::to('o4k/CategoryType')}}"  class="legitRipple" >Property Types </a></li>


				<li><a href="{{ URL::to('o4k/property_list')}}" class="legitRipple">Property Lists</a></li>
				<li><a href="{{ URL::to('o4k/property_category')}}" class="legitRipple">Property Categories</a></li>
				<li><a href="{{ URL::to('o4k/building_unit')}}" class="legitRipple">Building Units</a></li>
				<li><a href="{{ URL::to('o4k/land_unit')}}" class="legitRipple">Land Units</a></li>
				
				</ul>
			</li>
		<li ><a href="{{URL('/o4k/agents')}}"><i class="icon-home4"></i> <span>Agents</span></a></li>
		<li ><a href="{{URL('/o4k/utility')}}"><i class="icon-stack2"></i> <span>Utility</span></a></li>	
		<li ><a href="{{URL('/o4k/owners')}}"><i class="icon-home4"></i> <span>Owners</span></a></li>

		<li class="">
				<a href="#" class="has-ul legitRipple"><i class="icon-city"></i> <span>Home Slider</span></a>
				<ul class="hidden-ul" style="display: none;">
				<li><a href="{{ URL::to('o4k/sliderproperties')}}" class="legitRipple">Properties</a></li>
				<li><a href="{{ URL::to('o4k/slideragents')}}" class="legitRipple">Agents</a></li>
				<li><a href="{{ URL::to('o4k/sliderutility')}}" class="legitRipple">Utility</a></li>
				<li><a href="{{ URL::to('o4k/sliderowners')}}" class="legitRipple">Owners</a></li>
				</ul>
		</li>

		<li class="">
				<a href="#" class="has-ul legitRipple"><i class="icon-city"></i> <span>Frontend Settings</span></a>
				<ul class="hidden-ul" style="display: none;">
				<li><a href="{{ URL::to('o4k/menu')}}" class="legitRipple">Menu Management</a></li>
				<li>
					<a href="#">Project Type & Categories Management</a>
					<ul>
					<!-- 	<li><a href="{{ URL::to('o4k/CategoryType')}}" >Type Management</a></li> -->
						<li><a href="{{ URL::to('o4k/Category')}}" >Categories Management</a></li>
					</ul>
				</li>

				<li>
					<a href="#">Featured Properties Management</a>
					<ul>
						<li><a href="{{ URL::to('o4k/FeaturedCategory')}}" >Featured Categories</a></li>
						<li><a href="{{ URL::to('o4k/FeaturedProperties')}}" >Featured Properties</a></li>
						
					</ul>
				</li>


				<li><a href="{{ URL::to('o4k/mobileapp')}}" class="legitRipple">Mobile App Managment</a></li>

				<li><a href="{{ URL::to('metropoloancity')}}" class="legitRipple">Metropolian city</a></li>
				
				<li><a href="{{ URL::to('o4k/FeaturedCategory/sectionlist')}}" class="legitRipple">Section Managment</a></li>

				<li><a href="{{ URL::to('o4k/NewsUpdates')}}" class="legitRipple">News & Updates Management</a></li>

				<li><a href="{{ URL::to('o4k/SearchRadius')}}" class="legitRipple">Search Radius</a></li>

				</ul>
		</li>

		<li ><a href="{{URL('/o4k/background')}}"><i class="icon-home4"></i> <span>Home page Background Image</span></a></li>	
		<li ><a href="{{URL('/o4k/Advertise')}}"><i class="icon-home4"></i> <span>Advertise with us</span></a></li>	
  		<li ><a href="{{URL('/o4k/whyWe')}}"><i class="icon-home4"></i> <span>Why We</span></a></li>

        </ul>
    </div>
</div>
<!-- /main navigation -->
