<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getUsers = User::all();

        return response()->json($getUsers, 200);
    }

    /**
     * Register user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'max:255', Rule::unique(User::class)],
            'password' => ['confirmed', 'required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);

        return response()->json([
            'data' => $user,
            'message' => 'User created!'
        ]);
    }

    /**
     * Login user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' =>['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::where('email', $credentials['email'])
            ->first();

        if($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('UserToken:' . $credentials['email']);

            return response()->json([
                'data' => $user,
                'token' => $token,
                'message' => 'User logged in!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request) {
        $searchInput = $request->input;

        if($searchInput) {
            $datas = Model::where('inputName', 'LIKE', '%' . $searchInput . '%')
                ->get();

            return response()->json(['data' => $datas]);
        }
        else {
            return response()->json(['error' => 'No data.'], 400);
        }
    }
}

    // public function index(Request $request)
    // {
    //     $searchMovieInput = $request->search_movie;

    //     $movies = $searchMovieInput ? 
    //         Movie::where('name_movie', 'LIKE', '%' . $searchMovieInput . '%')
    //             ->get()
    //         : Movie::all();

    //     return view('movie.index', compact('movies', 'searchMovieInput'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('movie.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name_movie'=> 'required|string|max:255',
    //         'genre_movie'=> 'required|string|max:255',
    //         'duration_movie' => 'required|integer|min:30|max:120', // In minutes
    //     ]);

    //     Movie::create([
    //         'name_movie'=> $request->name_movie,
    //         'genre_movie' => $request->genre_movie, 
    //         'duration_movie' => $request->duration_movie
    //     ]);

    //     return redirect()
    //         ->route('movie.index')
    //         ->with('status', 'Movie created!');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $movieId)
    // {
    //     $getMovie = Movie::find($movieId);

    //     return view('movie.show', compact('getMovie'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $movieId)
    // {
    //     $getMovie = Movie::find($movieId);

    //     return view('movie.edit', compact('getMovie'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $movieId)
    // {
    //     $getMovie = Movie::find($movieId);

    //     $validatedMovie = $request->validate([
    //         'name_movie'=> 'required|string|max:255',
    //         'genre_movie'=> 'required',
    //         'duration_movie' => 'required|integer|min:1|max:500', // In minutes
    //     ]);

    //     $getMovie->fill($validatedMovie);

    //     $getMovie->save();

    //     return redirect()
    //         ->route('movie.index')
    //         ->with('status', 'Movie updated!');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $movieId)
    // {
    //     $getMovie = Movie::find($movieId);

    //     $getMovie->delete();

    //     return redirect()
    //         ->route('movie.index')
    //         ->with('status', 'Movie deleted!');
    // }
