<?php

$config = array(
    'user_add' => array(
        array(
            'field' => 'user_name',
            'label' => 'Username',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'login_name',
            'label' => 'Login Name',
            'rules' => 'required|min_length[5]|max_length[12]|is_unique[ah_user.login_name]'
        ),
        array(
            'field' => 'login_pwd',
            'label' => 'Password',
            'rules' => 'required|matches[passconf]|md5'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'required'
        ),
        array(
            'field' => 'user_type',
            'label' => 'User Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cell',
            'label' => 'Phone',
            'rules' => 'trim'
        )
        ,
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim'
        ),
        // array(
//                                            'field' => 'auth_id[]',
//                                            'label' => 'Authorized Modules',
//                                            'rules' => 'required'
//                                         ),
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        )
    ),
    'writercategory_add' => array(
        array(
            'field' => 'writer_category',
            'label' => 'Team category',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'newscategory_add' => array(
        array(
            'field' => 'news_category',
            'label' => 'News category',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'writer_add' => array(
        array(
            'field' => 'writer_name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'category',
            'label' => 'Category',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'writer_post',
            'label' => 'Post',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'writer_address',
            'label' => 'Address',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'writer_email',
            'label' => 'Email',
            'rules' => 'trim|valid_email|xss_clean'
        ),
    ),
    'user_edit' => array(
        array(
            'field' => 'user_name',
            'label' => 'Username',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'user_type',
            'label' => 'User Type',
            'rules' => 'trim'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        //array(
//                                            'field' => 'auth_id[]',
//                                            'label' => 'Authorized Modules',
//                                            'rules' => 'required'
//                                         ),
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'user_id',
            'label' => 'Status',
            'rules' => 'callback_uniqueUsername'
        )
    ),
    'content_add' => array(
        array(
            'field' => 'content_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'publication_add' => array(
        array(
            'field' => 'publication_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'publication_brief',
            'label' => 'Brief Description',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_details',
            'label' => 'Detail Description',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_date',
            'label' => 'Date',
            'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_status',
            'label' => 'Status',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ), // array(
        // 'field' => 'writer_id',
        //'label' => 'Writer',
        //'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        // ),
    //array(
    //'field' => 'publication_file',
    //'label' => 'File',
    // 'rules' => 'callback_ifupoad_check'
    ///'rules' => 'trim|required|valid_date[y/m/d,/]'callback_ifupoad_check
    //)
    ),
    'publication_edit' => array(
        array(
            'field' => 'publication_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'publication_brief',
            'label' => 'Brief Description',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_details',
            'label' => 'Detail Description',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_date',
            'label' => 'Date',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_order',
            'label' => 'Order',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'publication_status',
            'label' => 'Status',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ), //array(
        //'field' => 'writer_id',
        //'label' => 'Writer',
        //'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        // ),
        array(
            'field' => 'publication_category',
            'label' => 'File',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'callback_ifupoad_check
        )
    ),
    'project_add' => array(
        array(
            'field' => 'project_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'project_brief',
            'label' => 'Brief Description',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'project_details',
            'label' => 'Detail Description',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'project_lead',
            'label' => 'Project Lead',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'project_involved',
            'label' => 'Project Involved',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'project_status',
            'label' => 'Status',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ), // array(
    // 'field' => 'writer_id',
    //'label' => 'Writer',
    //'rules' => 'trim|required'
    ///'rules' => 'trim|required|valid_date[y/m/d,/]'
    // ),
    //array(
    //'field' => 'publication_file',
    //'label' => 'File',
    // 'rules' => 'callback_ifupoad_check'
    ///'rules' => 'trim|required|valid_date[y/m/d,/]'callback_ifupoad_check
    //)
    ),
    'banner_add' => array(
        array(
            'field' => 'path',
            'label' => 'Image',
            'rules' => 'callback_ifupoad_check'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'banner_update' => array(
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'advertisement_add' => array(
        array(
            'field' => 'path',
            'label' => 'Image',
            'rules' => 'callback_ifupoad_check'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'size',
            'label' => 'Size',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'advertisement_update' => array(
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'size',
            'label' => 'Size',
            'rules' => 'required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    
    
    'social_add' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'social_icon',
            'label' => 'Icon',
            'rules' => 'callback_ifupoad_check'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'social_title',
            'label' => 'Title',
            'rules' => 'trim|required'
        ),
    ),
    'social_update' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'social_title',
            'label' => 'Title',
            'rules' => 'trim|required'
        ),
    ),
    'category_add' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'cat_name',
            'label' => 'Category Name',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'category_update' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'cat_name',
            'label' => 'Category Name',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'character_add' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'character_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'character_image',
            'label' => 'Image',
            'rules' => 'callback_ifupoad_check'
        ),
    ),
    'character_update' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'character_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'publication_home_add' => array(
        array(
            'field' => 'pub_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'details',
            'label' => 'Details',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'pub_link',
            'label' => 'Link',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pub_status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'pub_image',
            'label' => 'Image',
            'rules' => 'callback_ifupoad_check'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
    ),
    'publication_home_edit' => array(
        array(
            'field' => 'pub_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'details',
            'label' => 'Details',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'pub_link',
            'label' => 'Link',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pub_status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'news_add' => array(
        array(
            'field' => 'news_title',
            'label' => 'Title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'news_brief',
            'label' => 'Brief Description',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'news_details',
            'label' => 'Detail Description',
            'rules' => 'trim'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'news_status',
            'label' => 'Status',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'category',
            'label' => 'Category',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'banner',
            'label' => 'Is Banner',
            'rules' => 'trim|required'
        ),
    ),
    'cartoon_add' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'brief_desc',
            'label' => 'Brief Description',
            'rules' => 'trim'
        ),
    ),
    'cartoon_update' => array(
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'brief_desc',
            'label' => 'Brief Description',
            'rules' => 'trim'
        ),
    ),
    'poll_add' => array(
        array(
            'field' => 'topic',
            'label' => 'Topic',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'change_password' => array(
        array(
            'field' => 'old_password',
            'label' => 'Old Password',
            'rules' => 'trim|required'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'login_pwd',
            'label' => 'New Password',
            'rules' => 'required|matches[passconf]|md5'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Confirm New Password',
            'rules' => 'trim|required|xss_clean'
        )
        ,
        array(
            'field' => 'old_password',
            'label' => 'Multiple Document',
            'rules' => 'callback_approveOldPassword_check'
        )
    ),
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|md5|xss_clean'
        )
    ),
	'album_add' => array(
        array(
            'field' => 'album_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        )
    ),
    'album_update' => array(
        array(
            'field' => 'album_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean'
        ///'rules' => 'trim|required|valid_date[y/m/d,/]'
        )
    ),
    'module_add'=>array(
        array(
            'field' => 'module_name',
            'label' => 'Module Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'module_controller',
            'label' => 'Module Controller',
            'rules' => 'trim|required|xss_clean'
        )
    ),
    
	'social_add'=>array(
        array(
            'field' => 'path',
            'label' => 'Social Media Icon',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'hover',
            'label' => 'Social Media Icon hover',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
    'menu_add' => array(
        array(
            'field' => 'menu_name',
            'label' => 'Menu Name',
            'rules'=> 'trim|required|xss_clean'
        ),array(
            'field' => 'menu_type',
            'label' => 'Menu Type',
            'rules'=> 'trim|required|xss_clean'
        ),
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules'=> 'trim|required|xss_clean'
        ),
        array(
            'field' => 'module',
            'label' => 'Menu Module',
            'rules'=> 'trim|required|xss_clean'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules'=> 'trim|required|xss_clean'
        ),
    )
    
);
?>