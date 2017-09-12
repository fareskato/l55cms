<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    const ENTITY_NAME = 'Tag';

    /**
     * TagController constructor.
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
    public function index()
    {
        // Get data fields
        $data = $this->indexSearchData();

        // Get all records
        $data['data_list']= Tag::all();

        // render template
        return view('admin.tag.list', $data);
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
        $record = new Tag();

        // Validation
        $options = [
            'name' => 'required|min:3',
        ];
        // validate the request
        $clean_data = $request->validate($options);

        // Create the record
        $record->create($clean_data);

        // redirect to list
        return redirect()->route('admin.tag.index');
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
        $data['record'] = Tag::findOrFail($id);

        // Form fields
        $data['form'] = $this->generateForm($id, $data['record']);

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
        // Get the record
        $record = Tag::findOrFail($id);

        // Validation
        $options = [
            'name' => 'required|min:3',
        ];
        // validate the request
        $clean_data = $request->validate($options);

        // Create the record
        $record->update($clean_data);

        // redirect to list
        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Get category
        $tag = Tag::findOrFail($id);
        $tag->delete();
        // Redirect to list page
        return redirect()->route('admin.tag.index');
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
            'action' => (isset($record)) ? route('admin.tag.update', ['id' => $id]) :  route('admin.tag.store'),

            // Determine if add or edit
            'is_edit' => (isset($record)) ? true :  false,

            'fields' => [
                'name' => [
                    'name' => 'name',
                    'id' => 'name',
                    'required' => 'required',
                    'type' => 'text',
                    'label' =>  self::ENTITY_NAME . ' ' .'name',
                    'placeholder' => 'Enter tag name',
                    'value' => (isset($record))  ? $record->name : '',
                ],
            ],
            'save_button' => [
                'type' => 'submit',
                'name' =>  ($id > 0) ? 'edit_tag' : 'add_tag',
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
                'url' => route('admin.tag.create'),
                'value' => 'Add'
            ],
            'cancel' => [
                'name' => 'cancel',
                'class' => 'default',
                'url' =>  route('admin.tag.index'),
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
        $data['data_list'] = Tag::getByNameOrBody($text,'name')->get();
        // render template
        return view('admin.search', $data);

    }



    private function indexSearchData()
    {
        // Initial data
        $data = [];

        // Determine the search form route
        $data['search_route'] = route('admin.tag.search');

        // Data will display in table
        $data['data_fields'] = ['id', 'name'];

        // Name of Entity
        $data['data_entity'] = self::ENTITY_NAME;

        // Will be displayed on page header
        $data['data_title'] = self::ENTITY_NAME;

        // Action buttons title
        $data['data_actions'] = 'Actions';

        // Record modifying buttons
        $data['action_buttons'] = [
            'edit' => [
                'name' => 'edit',
                'class' => 'pencil-square-o fa-2x text-success',
                'type' => strtolower(self::ENTITY_NAME),
                'route' => 'admin.tag.edit'
            ],
            'delete' => [
                'name' => 'delete',
                'class' => 'times fa-2x text-danger',
                'type' => strtolower(self::ENTITY_NAME),
                'route' => 'admin.tag.delete'
            ]
        ];

        // Back and add buttons
        $data['data_top_buttons'] = $this->generateTopButtons();

        // Return the data
        return $data;
    }



}
