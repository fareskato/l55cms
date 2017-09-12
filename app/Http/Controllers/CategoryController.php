<?php

/**
 * VERY Important : pass the $data array without compact to access all keys directly in the view
 */
namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    const ENTITY_NAME = 'Category';

    /**
     * Uploaded images folder path
     */
    const IMAGES_PATH = "images". DIRECTORY_SEPARATOR;

    /**
     * CategoryController constructor.
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

        // Get data fields
        $data = $this->indexSearchData();

        // Get all records
        $data['data_list']= Category::all();

        // render template
        return view('admin.category.list', $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create new record
        $record = new Category();

        // Validation
        $options = [
          'name' => 'required|min:3',
          'body' => 'required'
        ];
        // validate the request
        $request->validate($options);

        // Map data
        $record['name'] = $request->name;
        $record['slug'] = str_slug($request->name);
        $record['body'] = $request->body;

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
        return redirect()->route('admin.category.index');
    }


    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
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
        $data['record'] = Category::findOrFail($id);

        // Form fields
        $data['form'] = $this->generateForm($id, $data['record']);

        // Render template
        return view('admin.entityForm', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get the record
        $record = Category::findOrFail($id);

        // Validation
        $options = [
            'name' => 'required|min:3',
            'body' => 'required'
        ];
        // validate the request
        $request->validate($options);

        // Map data
        $record['name'] = $request->name;
        $record['slug'] = str_slug($request->name);
        $record['body'] = $request->body;

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
                $old_category_image = public_path("/"). self::IMAGES_PATH .$record['image'];
                unlink($old_category_image);
            }
            // 05- save image name in the Database
            $record['image'] = $img_name;
        }
        // Create the record
        $record->save();

        // redirect to list
        return redirect()->route('admin.category.index');
    }


    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Get category
        $category = Category::findOrFail($id);
        // Delete category and image (if exists)
        if($category->image !== null){
            $category_image = public_path("/"). self::IMAGES_PATH .$category->image ;
            $category->delete();
            unlink($category_image);
        }
        // Or just delete category
        $category->delete();

        // Redirect to list page
        return redirect()->route('admin.category.index');
    }


    /**
     * Create form
     * @param int $id
     * @param null $record
     * @return array
     */
    private function generateForm($id =0, $record = null)
    {
        $form = [
            // Form action via route
            'action' => (isset($record)) ? route('admin.category.update', ['id' => $id]) :  route('admin.category.store'),

            // Determine if add or edit
            'is_edit' => (isset($record)) ? true :  false,

            // Form fields
            'fields' => [
                'name' => [
                    'name' => 'name',
                    'id' => 'name',
                    'required' => 'required',
                    'type' => 'text',
                    'label' =>  self::ENTITY_NAME . ' ' .'name',
                    'placeholder' => 'Enter category name',
                    'value' => (isset($record))  ? $record->name : '',
                ],
                'body' => [
                    'name' => 'body',
                    'id' => 'body',
                    'required' => 'required',
                    'type' => 'textarea',
                    'label' =>  self::ENTITY_NAME . ' ' .'body',
                    'placeholder' => 'Enter category body',
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
                'name' =>  ($id > 0) ? 'edit_category' : 'add_category',
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
                'url' => route('admin.category.create'),
                'value' => 'Add'
            ],
            'cancel' => [
                'name' => 'cancel',
                'class' => 'default',
                'url' =>  route('admin.category.index'),
                'value' => 'Cancel'
            ]
        ];
        return $top_buttons;
    }


    /**
     * Search
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Get data fields
        $data = $this->indexSearchData();

        // Search
        $text = $request->input('s');

        // Search by name or body
        $data['data_list'] = Category::getByNameOrBody($text,'name', 'body')->get();

        // render template
        return view('admin.search', $data);

    }


    /**
     * Data uses for index and search
     * @return array
     */
    private function indexSearchData()
    {
        $data = [];

        // Determine the search form route
        $data['search_route'] = route('admin.category.search');

        // Data will display in table
        $data['data_fields'] = ['image', 'name','updated_at'];

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
            'edit' => [
                'name' => 'edit',
                'class' => 'pencil-square-o fa-2x text-success',
                'type' => strtolower(self::ENTITY_NAME),
                'route' => 'admin.category.edit'
            ],
            'delete' => [
                'name' => 'delete',
                'class' => 'times fa-2x text-danger',
                'type' => strtolower(self::ENTITY_NAME),
                'route' => 'admin.category.delete'
            ]
        ];

        // Back and add buttons
        $data['data_top_buttons'] = $this->generateTopButtons();

        // Return the data
        return $data;
    }
}
