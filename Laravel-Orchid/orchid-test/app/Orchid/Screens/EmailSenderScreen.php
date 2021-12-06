<?php

namespace App\Orchid\Screens;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Repository;
use Illuminate\Support\Facades\DB;

use App\Orchid\Layouts\ChartsLayout;


class EmailSenderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Analysis Screen';
    public $description = 'Analysis Screen';

    /**
     * Query data.
     *
     * @return array
     */
   public function query(): array
    {

        //$result = DB::connection('orchid-test')->select('SELECT name, level, price, institution FROM courses');
        
        $result = DB::select('SELECT name, level, price, institution FROM courses');
        
        //$courses = collect($result)->transform(fn(array $course) => new \Orchid\Screen\Repository($course));


        $charts = [
            [
                'labels' => ['Western Sydney University', 'Australian Catholic University', 
                      'Charles Sturt University', 'Macquarie University', 'University of NSW',
                      'University of Sydney', 'University of Technology Sydney', 'University of Wollongong', 
                      'Southern Cross University','University of New England', 'University of New Castle'],
                'title'  => 'Course Price',
                'values' => [28922, 28248, 28244, 38800, 44800, 45333, 30220, 26250, 30700],
            ],
            [
                'labels' => ['Western Sydney University', 'Australian Catholic University', 
                'Charles Sturt University', 'Macquarie University', 'University of NSW',
                'University of Sydney', 'University of Technology Sydney', 'University of Wollongong', 
                'Southern Cross University','University of New England', 'University of New Castle'],
                'title'  => 'Difference',
                'values' => [674, 678, -9878, -15878, -16411, 28922, -1298, 28922, 2672, -1778],
            ],
            
        ];

        return [
            'charts' => $charts,
            'data' => $result,
            new Repository(['id' => 100, 'name' => "shitty", 'price' => 0.1]),
        ];
    }
    

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Request Quick Scrape Now')
                //->icon('paper-plane')
              //  ->method('sendMessage')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('subject')
                    ->title('Subject')
                    ->required()
                    ->placeholder('Message subject line')
                    ->help('Enter the subject line for your message'),
    
                Relation::make('users.')
                    ->title('Recipients')
                    ->multiple()
                    ->required()
                    ->placeholder('Email addresses')
                    ->help('Enter the users that you would like to send this message to.')
                    ->fromModel(User::class,'name','email'),
                /*
                Quill::make('content')
                    ->title('Content')
                    ->required()
                    ->placeholder('Insert text here ...')
                    ->help('Add the content for the message that you would like to send.')
                */
            ]),
            /*
            Layout::table([
                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Repository $model) {
                        return "{$model->get('id')}";
                    }),
                TD::make('name', 'Name')
                    ->width('450')
                    ->render(function (Repository $model) {
                        return Str::limit($model->get('name'), 200);
                    }),

                TD::make('price', 'Price')
                    ->render(function (Repository $model) {
                        return '$ '.number_format($model->get('price'), 2);
                    }),
            ]),
            */
            Layout::columns([
                ChartsLayout::class,
            ]),
        ];
}

public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:6|max:50',
            'users'   => 'required',
            'content' => 'required|min:10'
        ]);

        Mail::raw($request->get('content'), function (Message $message) use ($request) {
            $message->from('sample@email.com');
            $message->subject($request->get('subject'));

            foreach ($request->get('users') as $email) {
                $message->to($email);
            }
        });


        Alert::info('Your email message has been sent successfully.');
    }
    
}