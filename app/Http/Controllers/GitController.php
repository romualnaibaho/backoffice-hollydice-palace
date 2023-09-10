<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class GitController extends Controller
{
    public function getRepositories()
    {
        $baseUrl = config('app.external_api_base_url');
        $response = Http::get("$baseUrl/search/repositories?q=git");

        if ($response->successful()) {
            $data = $response->json();

            $repositories = collect($data['items'])->map(function ($repository) {
                return [
                    'id' => $repository['id'],
                    'name' => $repository['name'],
                    'full_name' => $repository['full_name'],
                    'html_url' => $repository['html_url'],
                ];
            });

            // Use the paginate method on the collection
            $options = [
                "path" => config('app.url').'/backoffice/repositories'
            ];  
            $perPage = 10;
            $currentPage = request()->get('page', 1);
            $paginatedRepositories = $repositories->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $repositories = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedRepositories,
                count($repositories),
                $perPage,
                $currentPage,
                $options
            );

            return view('pages.backoffice.repositories', compact('repositories'));
        }

        return redirect()->route('repositories')->with('error', 'Failed to fetch data from the API');
    }
}
