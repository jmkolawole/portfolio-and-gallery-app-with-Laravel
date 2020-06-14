<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Home', route('dashboard'));
});

//Albums
Breadcrumbs::for('album.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Albums', route('album.index'));
});
//Create albums
Breadcrumbs::for('create.album', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Create Album', route('create.album'));
});

//Particular album
Breadcrumbs::for('album.show', function ($trail, $pictures) {
    $trail->parent('album.index');
    $trail->push($pictures->name, route('album.show', $pictures->id));
});

//Edit Album
Breadcrumbs::for('album.edit', function ($trail, $album) {
    $trail->parent('album.show',$album);
    $trail->push('edit', route('album.edit', $album->id));
});

//Pictures
Breadcrumbs::for('picture.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Pictures', route('picture.index'));
});


//Blog
Breadcrumbs::for('create.post', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Create Post', route('create.post'));
});


Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Posts', route('posts'));
});

Breadcrumbs::for('edit.post', function ($trail, $post) {
    $trail->parent('show.post',$post);
    $trail->push('Edit Post', route('edit.post', $post->id));
});


Breadcrumbs::for('show.post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push($post->title, route('show.post', $post->id));
});

//Tags
Breadcrumbs::for('tags', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('tags'));
});

Breadcrumbs::for('tag.resources', function ($trail,$tag) {
    $trail->parent('tags');
    $trail->push($tag->name, route('tag.resources', $tag->slug));
});


//Blog Category
Breadcrumbs::for('blog.categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Blog Categories', route('blog.categories'));
});

Breadcrumbs::for('blog.category.resources', function ($trail,$category) {
    $trail->parent('blog.categories');
    $trail->push($category->name, route('blog.category.resources', $category->slug));
});

//Subscribers
Breadcrumbs::for('subscribers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Subscribers', route('subscribers'));
});

//User Posts
Breadcrumbs::for('publisher.resources', function ($trail,$user) {
    $trail->parent('posts');
    $trail->push('Posts By '. $user->name, route('publisher.resources', $user->id));
});


Breadcrumbs::for('picture.add', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Picture', route('picture.add'));
});


//Particular picture
Breadcrumbs::for('picture.show', function ($trail, $picture) {
    $trail->parent('picture.index');
    $trail->push($picture->image, route('picture.show', $picture->id));
});

//Edit Picture
Breadcrumbs::for('picture.edit', function ($trail, $picture) {
    $trail->parent('picture.show',$picture);
    $trail->push('edit', route('picture.edit', $picture->id));
});



//Categories
Breadcrumbs::for('category.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('category.index'));
});

Breadcrumbs::for('category.resources', function ($trail,$category) {
    $trail->parent('category.index');
    $trail->push($category->name, route('category.resources', $category->slug));
});



//Testimonies
Breadcrumbs::for('testimony.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Testimonies', route('testimony.index'));
});

Breadcrumbs::for('testimony.add', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Testimonies', route('testimony.add'));
});

Breadcrumbs::for('testimony.show', function ($trail, $testimony) {
    $trail->parent('testimony.index');
    $trail->push($testimony->name, route('testimony.show', $testimony->id));
});
Breadcrumbs::for('testimony.edit', function ($trail, $testimony) {
    $trail->parent('testimony.show',$testimony);
    $trail->push('edit', route('testimony.edit', $testimony->id));
});


//Banner

Breadcrumbs::for('banner.home.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home Page Banner', route('banner.home.index'));
});

Breadcrumbs::for('banner.home.edit', function ($trail) {
    $trail->parent('banner.home.index');
    $trail->push('change', route('banner.home.edit'));
});
Breadcrumbs::for('banner.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Category Banner', route('banner.index'));
});

Breadcrumbs::for('banner.edit', function ($trail, $banner) {
    $trail->parent('banner.index');
    $trail->push('change', route('banner.edit',$banner->id));
});



//Users
Breadcrumbs::for('show.users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Administrators', route('show.users'));
});

Breadcrumbs::for('edit.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('edit.profile'));
});


Breadcrumbs::for('show.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Show Profile', route('show.profile'));
});


Breadcrumbs::for('edit.password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Change Password', route('edit.password'));
});

