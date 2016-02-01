<?php 
$CI = & get_instance();
$allowed = $CI->Auth_master_model->getAuth();
?>
<div class="container-fluid">
        <div class="row-fluid">
                
            <!-- left menu starts -->
            <div class="span2 main-menu-span">
                <?php if (in_array('user_add', $allowed) || in_array('user_view', $allowed)) {?>                        
                <div class="well nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">User Management</li>
                        <?php if (in_array('user_view', $allowed)) {?><li><a title="Manage User" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/userlist';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage User</span></a></li><?php }?>
                        <?php if (in_array('user_add', $allowed)) {?><li><a title="Add User" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/userlist/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add User</span></a></li><?php }?>
                    </ul>
                </div>
                <?php }?>
                <?php if (in_array('news_add', $allowed) || in_array('news_view', $allowed) || in_array('newscategory_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">News and Events Management</li>
                        <?php if (in_array('news_view', $allowed)) {?><li><a title="Manage News & Events" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/news';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage News & Events</span></a></li></li><?php }?>
                        <?php if (in_array('news_add', $allowed)) {?><li><a title="Add News & Events" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/news/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Post News</span></a></li></li><?php }?>
                        <?php if (in_array('newscategory_view', $allowed)) {?><li><a title="Manage News Category" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/newscategory';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Manage News Category</span></a></li></li><?php }?>                        
                    </ul>                    
                </div>
                <?php }?> 
       
                <?php if (in_array('advertisement_add', $allowed) || in_array('advertisement_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Advertisement Management</li>
                        <?php if (in_array('advertisement_view', $allowed)) {?><li><a title="Manage Advertisement" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/advertisement';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Advertisement</span></a></li></li><?php }?>
                        <?php if (in_array('advertisement_add', $allowed)) {?><li><a title="Add Advertisement" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/advertisement/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Advertisement</span></a></li></li><?php }?>                        
                    </ul>                    
                </div><!--/.well -->
                <?php }?>
                <?php if (in_array('content_add', $allowed) || in_array('content_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Content Management</li>
                        <?php if (in_array('content_view', $allowed)) {?><li><a title="Manage Content" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/content';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Content</span></a></li></li><?php }?>
                        <?php if (in_array('content_add', $allowed)) {?><li><a title="Add Content" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/content/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Content</span></a></li></li><?php }?>                        
                    <li><a title="Add Content" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/team';?>"><i class="icon-user"></i><span class="hidden-tablet">Manage Team</span></a></li></li>

                    </ul>                    
                </div>
                <?php }?>
                <!--<?php if (in_array('menu_view', $allowed) || in_array('menu_add', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Menu Management</li>
                        <?php if (in_array('menu_view', $allowed)) {?><li><a title="Manage Menu" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/menu';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Menu</span></a></li></li><?php }?>
                        <?php if (in_array('menu_add', $allowed)) {?><li><a title="Add Menu" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/menu/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Menu</span></a></li><?php }?>                       
                    </ul>
                </div>
                <?php }?>-->
                <?php if (in_array('album_add', $allowed) || in_array('album_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Album Management</li>
                        <?php if (in_array('album_view', $allowed)) {?><li><a title="Manage Album" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/album';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Album</span></a></li></li><?php }?>
                        <?php if (in_array('album_add', $allowed)) {?><li><a title="Add Album" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/album/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Album</span></a></li></li><?php }?>                        
                    </ul>
                    <!-- <label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label> -->
                </div>
                <?php }?>
              
                <?php if (in_array('publication_add', $allowed) || in_array('publication_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Publication Management</li>
                        <?php if (in_array('publication_view', $allowed)) {?><li><a title="Manage Publication" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/publication';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Publication</span></a></li></li><?php }?>
                        <?php if (in_array('publication_add', $allowed)) {?><li><a title="Add Publication" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/publication/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Publication</span></a></li></li><?php }?>                        
                    </ul>
                    <!-- <label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label> -->
                </div>
                <?php }?>
                <?php if (in_array('people_add', $allowed) || in_array('people_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">People Management</li>
                        <?php if (in_array('people_view', $allowed)) {?><li><a title="Manage People" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/writer';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage People</span></a></li></li><?php }?>
                        <?php if (in_array('writercategory_view', $allowed)) {?><li><a title="Manage Team Category" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/writercategory';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Team Category</span></a></li></li><?php }?>
                        <?php if (in_array('people_add', $allowed)) {?><li><a title="Add People" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/writer/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add People</span></a></li></li><?php }?>                        
                    </ul>
                    <!-- <label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label> -->
                </div>
                <?php }?>
                <?php if (in_array('module_add', $allowed) || in_array('module_view', $allowed)) {?>        
                <div class="well nav-collapse sidebar-nav">    
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Module Management</li>
                        <?php if (in_array('module_view', $allowed)) {?><li><a title="Manage Module" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/module';?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Module</span></a></li></li><?php }?>
                        <?php if (in_array('module_add', $allowed)) {?><li><a title="Add Module" class="ajax-link" data-rel="tooltip" href="<?php echo base_url().'administrator/module/add';?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Module</span></a></li></li><?php }?>  
                    </ul>                    
                </div>
                <?php }?>
                	<?php if (in_array('theme_option_update', $allowed)) {
			?>
			<div class="well nav-collapse sidebar-nav">
				<ul class="nav nav-tabs nav-stacked main-menu">
					<li class="nav-header hidden-tablet">
						Youtube Links
					</li>
					<li>
						<a title="Manage Youtube Links" class="ajax-link" data-rel="tooltip" href="<?php echo base_url() . 'administrator/theme_option'; ?>"><i class="icon-home"></i><span class="hidden-tablet"> Manage Youtube Links</span></a>
					</li></li>
				</ul>
			</div>
			<?php } ?>

                <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li class="nav-header hidden-tablet">
                        Manage User  Comments
                    </li>
                    <li>
                        <a href = "<?php echo base_url() . 'administrator/comments/commentView'; ?>"style = "color:#369bd7 ;"title="Manage User Comments" class="ajax-link" data-rel="tooltip" href=""><i class="icon-home"></i><span class="hidden-tablet"> Manage User  Comments</span></a>
                    </li></li>
                </ul>
            </div>
                
                
            </div><!--/span-->
            <!-- left menu ends -->