<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class PasteController extends BaseController
{
    /**
     * Return a single view by its ID.
     *
     * @param  string $token
     * @return mixed
     */
    public function view($token)
    {
        $paste = app("db")->table("pastes")->where("token", "=", $token)->first();

        if ($paste) {
            return view("view", [
                "tabs" => $paste->content,
                "created_at" => $paste->created_at
            ]);
        }

        return redirect()->route("index");
    }

    /**
     * Only return the content of a single paste by its ID.
     *
     * @param  string $token
     * @return mixed
     */
    public function viewRaw($token)
    {
        $paste = app("db")->table("pastes")->where("token", "=", $token)->first();
        return $paste->content;
    }

    /**
     * Stores a paste.
     *
     * @param  Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if ($request->has("tabs")) {
            $token = unique_random("pastes", "token", 12);

            $id = app("db")->table("pastes")->insert([
                "token" => $token,
                "content" => $request->get("tabs")
            ]);

            if ($id) {
                return $token;
            }
        }
        return redirect()->route("index");
    }
}
