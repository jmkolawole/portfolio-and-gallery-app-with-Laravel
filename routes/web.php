<?php


Route::group(['middleware' => 'web'], function (){

    //Front Pages
    Route::get('/', ['uses' => 'PagesController@home','as' => 'home']);
    Route::get('/gallery', ['uses' => 'PagesController@gallery','as' => 'gallery']);
    Route::get('/about', ['uses' => 'PagesController@about','as' => 'about']);
    Route::match(['get', 'post'], '/contact-us', 'PagesController@contact')->name('contact');
    Route::get('/portfolio/{slug}', ['uses' => 'PagesController@portfolio','as' => 'portfolio']);

    //Front end Album
    Route::get('/album/{slug}', ['uses' => 'PagesController@albumPhotos','as' => 'album.photo']);
    Route::get('/archives/albums/{year}/{month}', ['uses' => 'PagesController@albumArchive','as' => 'album.archives']);

    //Front end picture
    Route::get('/picture/{image}', ['uses' => 'PagesController@picture','as' => 'picture']);
    Route::get('/archives/pictures/{year}/{month}', ['uses' => 'PagesController@pictureArchive','as' => 'picture.archives']);


    //Blog
    Route::get('/blog', ['uses' => 'BlogController@index','as' => 'blog']);
    Route::get('/blog/{slug}', ['uses' => 'BlogController@single','as' => 'single']);

    //Comments
    Route::post('comment/create/{post}',['uses' => 'CommentController@addPostComment', 'as' => 'post.comment']);
    Route::post('reply/create/{comment}',['uses' => 'CommentController@addReplyComment', 'as' => 'reply.comment']);


    //Subscribers
    Route::post('/check-subscriber-email', ['uses' => 'PagesController@checkSubscriberEmail','as' => 'check.subscriber.email']);

    Route::post('/add-subscriber-email', ['uses' => 'PagesController@addSubscriberEmail','as' => 'add.subscriber.email']);

    Route::get('verify-subscriber/{email}/{token}', 'PagesController@verifySubscriber')->name('verify.subscriber');




    //Categories
    Route::get('/blog/category/{slug}', ['uses' => 'BlogController@categories','as' => 'categories.blog']);

    //Tags
    Route::get('/blog/tag/{slug}', ['uses' => 'BlogController@tags','as' => 'tags.blog']);


    Route::get('/blog/author/{slug}', ['uses' => 'BlogController@author','as' => 'author.blog']);

    //Archive
    Route::get('/archives/post/{year}/{month}', ['uses' => 'BlogController@postArchive','as' => 'post.archives']);

    //Search
    Route::get('/search','BlogController@search')->name('search');


    //Sitemaps
    Route::get('/sitemap.xml', 'SitemapController@index');
    Route::get('/sitemap.xml/albums', 'SitemapController@albums');
    Route::get('/sitemap.xml/pictures', 'SitemapController@pictures');
    Route::get('/sitemap.xml/categories', 'SitemapController@categories');
    Route::get('/sitemap.xml/blog/tags', 'SitemapController@tags');
    Route::get('/sitemap.xml/blog/posts', 'SitemapController@posts');
    Route::get('/sitemap.xml/blog/categories', 'SitemapController@blog_categories');




    Route::group(['middleware' =>'guest'],function(){

        //You have to be a guest to access these pages
        Route::match(['get', 'post'], '/admin-login', 'AuthController@signIn')->name('login.page');
        Route::get('/admin/password-reset', ['uses' => 'AuthController@linkRequest','as' => 'link.request']);
        Route::post('admin/password/email', 'Auth\ForgotPasswordController@ResetLinkEmail')->name('post.link.request');
        Route::get('admin/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('show.reset');
        Route::post('admin/reset-password', 'Auth\ResetPasswordController@postResetForm')->name('post.reset');

    });

    Route::group(['middleware' =>'auth'],function(){

        //For these pages, you have to be logged in
        //Dashboard
        Route::get('/admin/dashboard', ['uses' => 'AdminController@dashboard','as' => 'dashboard']);



        Route::group(['middleware' =>'roles', 'roles' => ['Admin','Author']],function(){

            //Categories
            Route::get('admin/categories', ['uses' => 'CategoryController@index','as' => 'category.index']);
            Route::get('admin/category/{slug}', ['uses' => 'CategoryController@showResources','as' => 'category.resources']);


            //Album
            Route::get('/admin/album/delete-photo/{pic}', ['uses' => 'PhotoController@delete','as' => 'photo.delete']);
            Route::get('/admin/albums', ['uses' => 'AlbumController@index','as' => 'album.index']);
            Route::get('admin/album/{id}', ['uses' => 'AlbumController@show','as' => 'album.show']);
            Route::match(['get', 'post'], '/admin/create-album', 'AlbumController@create')->name('create.album');
            Route::match(['get', 'post'], '/admin/edit-album/{id}', 'AlbumController@edit')->name('album.edit');
            Route::get('admin/album/delete-image/{id}', ['uses' => 'AlbumController@deleteImage','as' => 'album.delete-image']);


            //Album Photos
            Route::match(['get', 'post'], 'admin/album/{id}/add-photo', 'PhotoController@create')->name('photo.add');
            Route::get('/admin/album/{album_id}/{pic}', ['uses' => 'PhotoController@show','as' => 'photo.show']);


            //Single Pictures
            Route::match(['get', 'post'], '/admin/picture/add-picture', 'PictureController@create')->name('picture.add');
            Route::match(['get', 'post'], '/admin/picture/edit-picture/{id}', 'PictureController@edit')->name('picture.edit');
            Route::get('/admin/pictures', ['uses' => 'PictureController@index','as' => 'picture.index']);
            Route::get('/admin/pictures/{id}', ['uses' => 'PictureController@show','as' => 'picture.show']);


            //Testimonies
            Route::match(['get', 'post'], 'admin/testimony/add-testimony', 'TestimonyController@create')->name('testimony.add');
            Route::match(['get', 'post'], 'admin/testimony/edit-testimony/{id}', 'TestimonyController@edit')->name('testimony.edit');
            Route::get('/admin/testimonies', ['uses' => 'TestimonyController@index','as' => 'testimony.index']);
            Route::get('/admin/testimonies/{id}', ['uses' => 'TestimonyController@show','as' => 'testimony.show']);


            //Blog Categories
            Route::get('admin/blog-categories', ['uses' => 'BlogCategoryController@index','as' => 'blog.categories']);
            Route::get('admin/blog-category/{slug}', ['uses' => 'BlogCategoryController@showResources','as' => 'blog.category.resources']);


            //Tags
            Route::get('admin/tags', ['uses' => 'TagController@index','as' => 'tags']);
            Route::get('admin/tag/{slug}', ['uses' => 'TagController@showResources','as' => 'tag.resources']);

            //Tags
            Route::get('admin/publisher/{id}', ['uses' => 'AdminController@showResources','as' => 'publisher.resources']);



            //Posts
            Route::match(['get', 'post'], 'admin/create-post', 'PostController@create')->name('create.post');
            Route::get('admin/posts', 'PostController@index')->name('posts');
            Route::get('admin/show-post/{id}', 'PostController@show')->name('show.post');
            Route::match(['get', 'post'], 'admin/edit-post/{id}', 'PostController@edit')->name('edit.post');



            //Send Newsletter
            Route::get('admin/newsletter/{id}', 'SubscriberController@sendNewsletter')->name('send.newsletter');


            //Send Newsletter
            Route::get('admin/newsletter/{id}', 'SubscriberController@sendNewsletter')->name('send.newsletter');


            //Unsubscribe
            Route::get('/unsubscribe/{email}','BlogController@unsubscribe')->name('unsubscribe');

            //Tags
            Route::get('admin/blog/tag/{slug}', 'TagController@showResources')->name('tag.resources');

            //Categories
            Route::get('admin/blog/category/{slug}', 'BlogCategoryController@showResources')->name('blog.category.resources');

            //Subscribers
            Route::get('admin/blog/subscribers', 'SubscriberController@index')->name('subscribers');


        });


        Route::group(['middleware' =>'roles', 'roles' => 'Admin'],function(){
            //Users
            Route::get('/admin/users',['uses' => 'AdminController@showUsers', 'as' => 'show.users']);
            Route::post('/admin/user/assign',['uses' => 'AdminController@assignUser', 'as' => 'assign.user']);
            Route::post('/admin/user/edit-user',['uses' => 'AdminController@editUser', 'as' => 'edit.user']);
            Route::post('/admin/user/add',['uses' => 'AdminController@addUser', 'as' => 'add.user']);
            Route::post('/admin/user/delete',['uses' => 'AdminController@destroy', 'as' => 'delete.user']);

            //limits
            Route::POST('admin/add-category','CategoryController@addCategory')->name('add.category');
            Route::POST('admin/edit-category/{id}','CategoryController@editCategory')->name('edit.category');
            Route::POST('admin/delete-category/{id}','CategoryController@deleteCategory')->name('delete.category');

            //Authors can not delete albums
            Route::get('admin/album-delete/{id}', ['uses' => 'AlbumController@delete', 'as' => 'album.delete']);


            //Can't delete picture as well
            Route::get('/admin/pictures/delete-picture/{id}', ['uses' => 'PictureController@delete','as' => 'picture.delete']);


            //Can't delete testimony too
            Route::get('/admin/testimonies/delete-testimony/{id}', ['uses' => 'TestimonyController@delete','as' => 'testimony.delete']);

            //They can't change banners too
            //Category Banners
            Route::match(['get', 'post'], 'admin/banner/change-banner/{id}', 'BannerController@edit')->name('banner.edit');
            Route::get('/admin/banner/all', ['uses' => 'BannerController@index','as' => 'banner.index']);

            //Homepage Banners
            Route::match(['get', 'post'], 'admin/home-banner/change-banner', 'BannerController@editHome')->name('banner.home.edit');
            Route::get('/admin/home-banner/show', ['uses' => 'BannerController@indexHome','as' => 'banner.home.index']);


            //Blog
            //Categories
            Route::POST('admin/add-blog-category','BlogCategoryController@addCategory')->name('add.blog.category');
            Route::POST('admin/edit-blog-category/{id}','BlogCategoryController@editCategory')->name('edit.blog.category');
            Route::POST('admin/delete-blog-category/{id}','BlogCategoryController@deleteCategory')->name('delete.blog.category');


            //Tags
            Route::POST('admin/add-tag','TagController@addTag')->name('add.tag');
            Route::POST('admin/edit-tag/{id}','TagController@editTag')->name('edit.tag');
            Route::POST('admin/delete-tag/{id}','TagController@deleteTag')->name('delete.tag');



            Route::get('admin/publish-post/{id}', ['uses' => 'PostController@publishPost', 'as' => 'publish.post']);
            Route::get('admin/hide-post/{id}', ['uses' => 'PostController@hidePost', 'as' => 'hide.post']);
            Route::get('admin/allow-comment/{id}', ['uses' => 'PostController@allowComment', 'as' => 'allow.comment']);
            Route::get('admin/disallow-comment/{id}', ['uses' => 'PostController@disallowComment', 'as' => 'disallow.comment']);


            //Comments
            Route::POST('admin/edit-comment/{id}','CommentController@update')->name('update.comment');
            Route::get('admin/delete-comment/{id}','CommentController@destroy')->name('delete.comment');
            Route::get('admin/hide-comment/{id}','CommentController@hide')->name('hide.comment');
            Route::get('admin/show-comment/{id}','CommentController@show')->name('show.comment');



            //Delete Post
            Route::get('admin/delete-post/{id}','PostController@delete')->name('delete.post');


            Route::POST('admin/check-tag','TagController@checkTag')->name('check.tag');


            //Delete Subscriber
            Route::get('admin/delete-subscriber/{id}','SubscriberController@delete')->name('delete.subscriber');


            //Print Subscribers
            Route::get('admin/export-subscribers-email','SubscriberController@exportSubscriberEmail')->name('export.email');

        });


        Route::get('/logout', ['uses' => 'AuthController@getLogout','as' => 'logout']);

        //Logged In Users
        Route::match(['get', 'post'], '/admin/edit-profile', 'AdminController@editProfile')->name('edit.profile');
        Route::get('/admin/show-profile',['uses' => 'AdminController@showProfile', 'as' => 'show.profile']);
        Route::match(['get', 'post'], '/admin/change-password', 'AdminController@editPassword')->name('edit.password');


    });





});












