Notes for Laravel project continued



Adding data:

1\. create a form with a post method: action="{{ route('data.store') }}" method="POST" /n @csrf

2\. add the corresponding route that points to the controller

3\. in the controller, create a new instance of the data (using the model) and populate it with data using $request. finally, use the $data->save() method. Optionally: add a return redirect()->route('name.route')



Deleting data (with *route model binding*):

1\. add delete button with a post method: action="{{ route('data.destroy', *$data*) }}" method="POST" /n @csrf /n @method('DELETE")

2\. add the corresponding route that points to the controller: Route::delete('/posts/*{post}*', ...)->name(...);

3\. in the controller, call the delete method on $data



Showing data:









<!-- ADD LATER: action="{{ route('posts.edit', $post) }}" method="POST" -->

