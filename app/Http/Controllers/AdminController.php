<?php

namespace App\Http\Controllers;

use App\donates;
use Carbon\Carbon;
use App\User;
use App\Page;
use App\Sections;
use App\Settings;
use Illuminate\Http\Request;
use App\Server;
use App\News;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $now = Carbon::today();

        $monday = User::all()->where('created_at');
        return view('admin.index');
    }

    public function servers() {
        $servers = Server::all();
        return view('admin.servers', compact('servers'));
    }

    public function news() {
        $news = News::paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(){
        Server::create([
            'name' => request('name'),
            'ip' => request('ip'),
            'rcon' => request('rcon'),
            'shop' => request('shop')
        ]);
        return redirect('/admin/servers');
    }

    public function delete(){
        $id = request('id');

        $server = Server::where('id', $id)->find($id);

        $server->delete();

        return redirect('/admin/servers');
    }

    public function createNews(){
        News::create([
            'title' => request('title'),
            'mini_body' => request('mini_body'),
            'image' => request('image'),
            'body' => request('body'),
            'tech_name' => request('tech_name'),
            'write_by' => request('write_by')
        ]);
        return redirect('/admin/news');
    }

    public function deleteNews(){
        $id = request('id');

        $news = News::where('id', $id)->find($id);

        $news->delete();

        return redirect('/admin/news');
    }

    public function newsEditor($tech_name){
        $news = News::all()->where('tech_name', $tech_name)->first();

        return view('admin.news.show', compact('news'));
    }

    public function newsEdit(){
        $tech_name = request('tech_name');
        $title = request('title');
        $mini_body = request('mini_body');
        $image = request('image');
        $body = request('body');

        $getNewsById = News::where('tech_name', $tech_name);

        $getNewsById->update(array(
           'tech_name' => $tech_name,
           'title' => $title,
           'mini_body' => $mini_body,
           'image' => $image,
           'body' => $body
        ));

        return redirect('admin/news');
    }

    public function pageIndex(){
        $pages = Page::paginate(5)->sortBy('created_at');

        return view('admin.page.index', compact('pages'));
    }

    public function deletePage(){
        $id = request('id');

        $page = Page::where('id', $id)->find($id);

        $page->delete();

        return redirect('/admin/page');
    }

    public function createPage(){
        Page::create([
            'tech_name' => request('tech_name'),
            'html' => request('html'),
            'css' => request('css')
        ]);

        return redirect('/admin/page');
    }

    public function pageEditor($tech_name){
        $page = Page::all()->where('tech_name', $tech_name)->first();

        return view('admin.page.show', compact('page'));
    }

    public function pageEdit(){
        $tech_name = request('tech_name');
        $getPageById = Page::where('tech_name', $tech_name);

        $getPageById->update(array(
            'html' => request('html'),
            'css' => request('css'),
            'tech_name' => request('tech_name')
        ));

        return redirect('admin/page');
    }

    public function settings(){
        if (!Settings::all()->first()){ // Проверка, есть ли таблица с настройками.
            Settings::create([
                'UnitPay_PublicKey' => 'demo',
                'UnitPay_SecretKey' => 'demo',
                'forum' => '0'
            ]);
        }

        $settings = Settings::all()->first();
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(){
        $unitpaypk = request('upaypk');
        $unitpaysk = request('upaysk');
        $forum = request('forum');

        $setings = Settings::all()->first();

        $setings->update(array(
            'UnitPay_PublicKey' => $unitpaypk,
            'UnitPay_SecretKey' => $unitpaysk,
            'forum' => $forum
        ));
        return redirect('admin/settings');
    }

    public function donates() {
        $donates = donates::all();

        $servers = Server::all();

        return view('admin.donate.index', compact('donates', 'servers'));
    }

    public function donateDelete(){
        $id = request('id');

        $donate = donates::where('id', $id)->find($id);

        $donate->delete();

        return redirect('/admin/donate');
    }

    public function donateCreate() {
        $name = request('name');
        $cmd = request('cmd');
        $tech_name = request('tech_name');
        $price = request('price');
        $server = request('server');

        donates::create([
            'name' => $name,
            'cmd' => $cmd,
            'tech_name' => $tech_name,
            'price' => $price,
            'server_id' => $server
        ]);

        return redirect('admin/donate');
    }
}
