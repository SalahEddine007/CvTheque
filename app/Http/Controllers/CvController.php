<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;

use App\Cv;

use App\Experience;

use Auth;

use App\Http\Requests\cvRequest;

class CvController extends Controller
{

    public function __construct(){

        $this->middleware('auth');
    }

    //Lister des cvs
    public function index() {

       //$listcv = Auth::user()->cvs;                       

        if(Auth::user()->is_admin) {
            $listcv = Cv::all();
        }else{
            $listcv = Auth::user()->cvs;              
        }

        return view('cv.index', ['cvs' => $listcv]);

    }

    //Affiche le fomulaire de creation de cv
    public function create() {
        return view('cv.create');
    }

    //Enregister un cv
    public function store(cvRequest $request) {

        $cv = new Cv();

        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->user_id = Auth::user()->id;

        if($request->hasFile('photo')) {
        $cv->photo = $request->photo->store('image');
        }
        


        $cv->save();

        session()->flash('success', 'Le cv à été bien enrregistré !!');

        return redirect('cvs');
        
    }

    //Permet de récupèrer un cv puis de le mettre dans un formilaire
    public function edit($id) {

        $cv = Cv::find($id);

        $this->authorize('update', $cv);

        return view('cv.edit', ['cv' => $cv]);
    }

    //Permet de modifier un cv
    public function update(cvRequest $request, $id) {

        $cv = Cv::find($id);

        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');

        if($request->hasFile('photo')) {
            $cv->photo = $request->photo->store('image');
            }

        $cv->save();

        session()->flash('success', 'Le cv à été bien modifier !!');

        return redirect('cvs');
        
    }

    public function show($id) {
        return view('cv.show', ['id' => $id]);
    }

    //Permet de supprimer un cv
    public function destroy(Request $request, $id) {
        
        $cv = Cv::find($id);

        $this->authorize('delete', $cv);

        $cv->delete();

        return redirect('cvs');
    }

    public function getExperiences($id) {
        $cv = Cv::find($id);
        return $cv->experiences()->orderBy('debut','desc')->get();
    }

    public function addExperience(Request $request) {
        $experience = new Experience;

        $experience->titre = $request->titre;
        $experience->body = $request->body;
        $experience->debut = $request->debut;
        $experience->fin = $request->fin;
        $experience->cv_id = $request->cv_id;

        $experience->save();

        return Response()->json(['etat' => true, 'id' => $experience->id]);
    }
}
