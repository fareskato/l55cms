<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    const ENTITY_NAME = 'Post';

    // pagination
    const LIMIT = 10;

    /**
     * Uploaded images folder path
     */
    const IMAGES_PATH = "images". DIRECTORY_SEPARATOR;

    /**
     * PostController constructor.
     * Just authenticated user
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        // Initial data
        $data = [];

        // Get all records
        $data['data_list']= Post::orderBy('created_at', 'disc')->simplePaginate(self::LIMIT); // or paginate(3)

        // Data will display in table
        $data['data_fields'] = ['image', 'title', 'category_id', 'status'];

        // Name of Entity
        $data['data_entity'] = self::ENTITY_NAME;

        // Will be displayed on page header
        $data['data_title'] = self::ENTITY_NAME;

        // Action buttons title
        $data['data_actions'] = 'Actions';

        // Images path
        $data['images_path'] = self::IMAGES_PATH;

        // image thumbnail
        $data['data_thumbnail'] = 'small';

        // Record modifying buttons
        $data['action_buttons'] = [
            'publish' => [
                'name' => 'publish',
                'class' => 'repeat fa-2x text-black',
                'type' => strtolower(self::ENTITY_NAME),
            ],
            'show' => [
                'name' => 'show',
                'class' => 'eye fa-2x text-primary',
                'type' => strtolower(self::ENTITY_NAME),
            ],
            'edit' => [
                'name' => 'edit',
                'class' => 'pencil-square-o fa-2x text-success',
                'type' => strtolower(self::ENTITY_NAME),
            ],
            'delete' => [
                'name' => 'delete',
                'class' => 'times fa-2x text-danger',
                'type' => strtolower(self::ENTITY_NAME),
            ]
        ];

        // Back and add buttons
        $data['data_top_buttons'] = $this->generateTopButtons();

        // render template
        return view('admin.post.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Initial data
        $data = [];

        // Will be displayed on page header
        $data['data_title'] = 'Create'.' '. strtolower(self::ENTITY_NAME);

        // Back and add buttons
        $data['data_top_buttons'] = $this->generateTopButtons();

        // Form fields
        $data['form'] = $this->generateForm();
        // Render form page

        return view('admin.entityForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create new record
        $record = new Post();

        // Validation
        $options = [
            'title' => 'required|min:3',
            'body' => 'required',
            'image' => 'mimes:jpeg,jpg,png,jpeg,gif',
            'category_id' => 'required',
        ];
        // validate the request
        $request->validate($options);

        // Map data
        $record['title'] = $request->title;
        $record['slug'] = str_slug($request->title);
        $record['body'] = $request->body;
        $record['excerpt'] = str_limit($request->body, 100);
        // user_id : the current user
        $record['user_id'] = Auth::id();
        $record['category_id'] = $request->category_id;
        $record['published_at'] = Carbon::now();
        //Image handling
        if($request->hasFile('image')){
            // 01-  upload the image
            $img = Image::make($request->file('image'));
            // 02- rename the uploaded image
            $img_name =  Carbon::now()->timestamp.'_'.$request->file('image')->getClientOriginalName();
            // 03- save image in target folder
            $img->save(public_path('/'). self::IMAGES_PATH . $img_name );
            // 04- save image name in the Database
            $record['image'] = $img_name;
        }

        // Create the record
        $record->save();

        // redirect to list
        return redirect()->route('admin.post.index');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Initial data
        $data = [];

        // Will be displayed on page header
        $data['data_title'] = 'Update' .' '. strtolower(self::ENTITY_NAME);

        // Back and add buttons
        $data['data_top_buttons'] = $this->generateTopButtons($id);

        // Get the record
        $data['record'] = Post::findOrFail($id);

        // Form fields
        $data['form'] = $this->generateForm($id, $data['record'], $data['record']->category);

        // Render template
        return view('admin.entityForm', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Create new record
        $record = Post::findOrFail($id);

        // Validation
        $options = [
            'title' => 'required|min:3',
            'body' => 'required',
            'image' => 'mimes:jpeg,jpg,png,jpeg,gif',
            'category_id' => 'required',
        ];
        // validate the request
        $request->validate($options);

        // Map data
        $record['title'] = $request->title;
        $record['slug'] = str_slug($request->title);
        $record['body'] = $request->body;
        $record['excerpt'] = str_limit($request->body, 100);
        // user_id : the current user
        $record['user_id'] = Auth::id();
        $record['category_id'] = $request->category_id;
        $record['published_at'] = Carbon::now();
        //Image handling
        if($request->hasFile('image')){
            // 01-  upload the image
            $img = Image::make($request->file('image'));
            // 02- rename the uploaded image
            $img_name =  Carbon::now()->timestamp.'_'.$request->file('image')->getClientOriginalName();
            // 03- save image in target folder
            $img->save(public_path('/'). self::IMAGES_PATH . $img_name );
            // 04- Remove the old image
            if($record['image']){
                $old_post_image = public_path("/"). self::IMAGES_PATH .$record['image'];
                if(file_exists($old_post_image)){
                    unlink($old_post_image);
                }
            }
            // 05- save image name in the Database
            $record['image'] = $img_name;
        }

        // Create the record
        $record->save();

        // redirect to list
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Get post
        $post = Post::findOrFail($id);
        // Delete post and image (if exists)
        if($post->image !== null){
            $post_image = public_path("/"). self::IMAGES_PATH .$post->image ;
            $post->delete();
            if(file_exists($post_image)){
                unlink($post_image);
            }
        }
        // Or just delete post
        $post->delete();

        // Redirect to list page
        return redirect()->route('admin.post.index');
    }


    /**
     * Update post status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        $post = Post::findOrFail($id);
        if($post->status == 0){
            $post->status = 1;
            $post->published_at = Carbon::now();
            $post->update(['status', $post->status, 'published_at' => Carbon::now()]);
        }else{
            $post->status = 0;
            $post->published_at = Carbon::now();
            $post->update(['status', $post->status]);
        }

        // Redirect back
        return redirect()->back();
    }


    /**
     * Create form
     * @param int $id
     * @param null $record
     * @param null $categories
     * @return array
     */
    private function generateForm($id =0, $record = null, $categories = null)
    {
        // Get all categories
        $categories = Category::all();

        $form = [
            'action' => (isset($record)) ? route('admin.post.update', ['id' => $id]) :  route('admin.post.store'),
            'fields' => [
                'title' => [
                    'name' => 'title',
                    'id' => 'title',
                    'required' => 'required',
                    'type' => 'text',
                    'label' =>  self::ENTITY_NAME . ' ' .'title',
                    'placeholder' => 'Enter post title',
                    'value' => (isset($record))  ? $record->title : '',
                ],
                'category_id' => [
                    'name' => 'category_id',
                    'id' => 'category_id',
                    'required' => 'required',
                    'type' => 'select',
                    'label' =>  self::ENTITY_NAME . ' ' .'category',
                    'placeholder' => 'Select category',
                    'value' => (isset($record))  ? $record->category->id : '',
                    'options' => $categories,
                    'object_id' => (isset($record))  ? $record->category->id : '',
                ],
                'body' => [
                    'name' => 'body',
                    'id' => 'body',
                    'required' => 'required',
                    'type' => 'textarea',
                    'label' =>  self::ENTITY_NAME . ' ' .'body',
                    'placeholder' => 'Enter post body',
                    'value' => (isset($record))  ? $record->body : '',
                ],
                'image' => [
                    'name' => 'image',
                    'id' => 'image',
                    'required' => '',
                    'type' => 'file',
                    'label' => self::ENTITY_NAME . ' ' .'image',
                    'value' => '',
                ],
            ],
            'save_button' => [
                'type' => 'submit',
                'name' =>  ($id > 0) ? 'edit_post' : 'add_post',
                'value' => 'Save',
            ]
        ];
        return $form;
    }


    /**
     * Top buttons for all templates & models
     * @param int $id
     * @return array
     */
    private function generateTopButtons($id = 0)
    {
        $class = ($id > 0) ? 'hidden' : '' ;
        $top_buttons = [
            'add' => [
                'name' => 'add',
                'class' => 'primary ' .$class,
                'url' => route('admin.post.create'),
                'value' => 'Add'
            ],
            'cancel' => [
                'name' => 'cancel',
                'class' => 'default',
                'url' =>  route('admin.post.index'),
                'value' => 'Cancel'
            ]
        ];
        return $top_buttons;
    }




}
