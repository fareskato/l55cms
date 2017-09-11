<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const ENTITY_NAME = 'User';

    // pagination
    const LIMIT = 10;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {

        // Initial data
        $data = [];

        // Get all records
        $data['data_list']= User::orderBy('created_at', 'disc')->simplePaginate(self::LIMIT); // or paginate(3)

        // Data will display in table
        $data['data_fields'] = ['id', 'Name', 'Email', 'Role', 'Created at'];

        // Name of Entity
        $data['data_entity'] = self::ENTITY_NAME;

        // Will be displayed on page header
        $data['data_title'] = self::ENTITY_NAME;

        // Action buttons title
        $data['data_actions'] = 'Actions';

        // Record modifying buttons
        $data['action_buttons'] = [
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
        return view('admin.users.list', $data);
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
                'url' => route('admin.user.create'),
                'value' => 'Add'
            ],
            'cancel' => [
                'name' => 'cancel',
                'class' => 'default',
                'url' =>  route('admin.user.index'),
                'value' => 'Cancel'
            ]
        ];
        return $top_buttons;
    }


}
