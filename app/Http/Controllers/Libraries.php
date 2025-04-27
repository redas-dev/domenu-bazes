<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Libraries extends Controller
{
    public function index()
    {
        $libraries = DB::select('
            select b.*, v.Slapyvardis
            from Bibliotekos as b
            left join Bibliotekos_priziuretojas as bp on b.id = bp.fk_Biblioteka
            left join Vartotojai as v on bp.fk_Vartotojas = v.id
            where bp.Role = "Savininkas"
        ');

        return view('table', ['libraries' => $libraries]);
    }

    public function edit($libraryId)
    {
        $library = DB::selectOne('
            select b.*, v.Slapyvardis
            from Bibliotekos as b
            left join Bibliotekos_priziuretojas as bp on b.id = bp.fk_Biblioteka
            left join Vartotojai as v on bp.fk_Vartotojas = v.id
            where bp.Role = "Savininkas" and b.id = ?
        ', [$libraryId]);

        $maintainers = DB::select('
            select v.*, bp.Role
            from Vartotojai as v
            left join Bibliotekos_priziuretojas as bp on v.id = bp.fk_Vartotojas
            left join Bibliotekos as b on bp.fk_Biblioteka = b.id
            where bp.fk_Biblioteka = ?
        ', [$libraryId]);

        $versions = DB::select('
            select v.*
            from Versijos as v
            where v.fk_Biblioteka = ?
        ', [$libraryId]);

        return view('edit', ['library' => $library, 'maintainers' => $maintainers, 'versions' => $versions]);
    }

    public function delete($libraryId)
    {
        DB::delete('delete from Bibliotekos where id = ?', [$libraryId]);
        return redirect('/');
    }

    public function create()
    {
        $users = DB::select('select * from Vartotojai');

        return view('create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Pavadinimas' => 'required|string',
            'Aprasymas' => 'required|string',
            'Licenzija' => 'required|string',
            'Privati' => 'required|string',
            'Repozitorija' => 'required|string',
            'Raktazodziai' => 'required|string',
            'Kalba' => 'required|string',
            'Palaikymo_busena' => 'required|string',
            'Savininkas' => 'required|string',
            'versions' => 'required|array',
            'versions.*.Versija' => 'required|string',
            'versions.*.Pakeitimu_aprasas' => 'required|string',
            'versions.*.Pasenusi' => 'required|string',
            'versions.*.Atsisiuntimu_skaicius' => 'required|integer',
            'versions.*.Zyme' => 'required|string',
            'versions.*.Eksperimentine' => 'required|string',
            'versions.*.Stabilumo_lygis' => 'required|string',
        ]);

        $pavadinimas = request('Pavadinimas');
        $aprasymas = request('Aprasymas');
        $licenzija = request('Licenzija');
        $privati = request('Privati');
        $repozitorija = request('Repozitorija');
        $raktazodziai = request('Raktazodziai');
        $kalba = request('Kalba');
        $busena = request('Palaikymo_busena');
        $savininkoId = request('Savininkas');

        $versijos = request('versions');

        DB::insert('
            insert into Bibliotekos (
             Pavadinimas,
             Aprasymas,
             Licenzija,
             Privati,
             Repozitorija,
             Raktazodziai,
             Kalba,
             Palaikymo_busena
            )
            values (?, ?, ?, ?, ?, ?, ?, ?)'
            ,[$pavadinimas, $aprasymas, $licenzija, $privati, $repozitorija, $raktazodziai, $kalba, $busena]);

        DB::insert('
            insert into Bibliotekos_priziuretojas (fk_Biblioteka, fk_Vartotojas, Role)
            values ((select id from Bibliotekos where Pavadinimas = ?), ?, "Savininkas")'
            ,[$pavadinimas, $savininkoId]);

        foreach ($versijos as $versija) {
            DB::insert('
                insert into Versijos (
                  Versija,
                  Pakeitimu_aprasas,
                  Deprecated,
                  Atsisiuntimu_skaicius,
                  Zyme,
                  Eksperimentine,
                  Stabilumo_lygis,
                  fk_Biblioteka
                )
                values (?, ?, ?, ?, ?, ?, ?, (select id from Bibliotekos where Pavadinimas = ?))'
                ,[$versija['Versija'], $versija['Pakeitimu_aprasas'], $versija['Pasenusi'], $versija['Atsisiuntimu_skaicius'], $versija['Zyme'], $versija['Eksperimentine'], $versija['Stabilumo_lygis'], $pavadinimas]);
        }

        return redirect('/');
    }

    public function update(Request $request, $libraryId)
    {
        $request->validate([
            'Pavadinimas' => 'required|string',
            'Aprasymas' => 'required|string',
            'Licenzija' => 'required|string',
            'Privati' => 'required|string',
            'Repozitorija' => 'required|string',
            'Raktazodziai' => 'required|string',
            'Kalba' => 'required|string',
            'Palaikymo_busena' => 'required|string',
            'Savininkas' => 'required|string',
            'versions' => 'required|array',
            'versions.*.Veiksmas' => 'required|string',
            'versions.*.Versija' => 'required|string',
            'versions.*.Pakeitimu_aprasas' => 'required|string',
            'versions.*.Pasenusi' => 'required|string',
            'versions.*.Atsisiuntimu_skaicius' => 'required|integer',
            'versions.*.Zyme' => 'required|string',
            'versions.*.Eksperimentine' => 'required|string',
            'versions.*.Stabilumo_lygis' => 'required|string',
        ]);

        try {
            // Get form data
            $pavadinimas = request('Pavadinimas');
            $savininkoId = request('Savininkas');
            $aprasymas = request('Aprasymas');
            $licenzija = request('Licenzija');
            $privati = request('Privati');
            $repozitorija = request('Repozitorija');
            $raktazodziai = request('Raktazodziai');
            $kalba = request('Kalba');
            $busena = request('Palaikymo_busena');
            $versions = request('versions');

            // Update library info
            DB::update('
                update Bibliotekos as b
                set
                    b.Pavadinimas = ?,
                    b.Aprasymas = ?,
                    b.Licenzija = ?,
                    b.Privati = ?,
                    b.Repozitorija = ?,
                    b.Raktazodziai = ?,
                    b.Kalba = ?,
                    b.Palaikymo_busena = ?
                where b.id = ?',
                [$pavadinimas, $aprasymas, $licenzija, $privati, $repozitorija, $raktazodziai, $kalba, $busena, $libraryId]
            );

            DB::update('
                update Bibliotekos_priziuretojas as bp
                set
                    bp.fk_Vartotojas = ?
                where bp.fk_Biblioteka = ? and bp.Role = "Savininkas"',
                [$savininkoId, $libraryId]
            );

            // Process versions
            if ($versions) {
                foreach ($versions as $version) {
                    if ($version['Veiksmas'] === 'new') {
                        DB::insert('
                            INSERT INTO Versijos (
                              Versija,
                              Pakeitimu_aprasas,
                              Deprecated,
                              Atsisiuntimu_skaicius,
                              Zyme,
                              Eksperimentine,
                              Stabilumo_lygis,
                              fk_Biblioteka
                            )
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
                            [
                                $version['Versija'],
                                $version['Pakeitimu_aprasas'],
                                $version['Pasenusi'],
                                $version['Atsisiuntimu_skaicius'],
                                $version['Zyme'],
                                $version['Eksperimentine'],
                                $version['Stabilumo_lygis'],
                                $libraryId
                            ]
                        );
                    } else if ($version['Veiksmas'] === 'update') {
                        // Update existing version
                        DB::update('
                            UPDATE Versijos
                            SET
                                Versija = ?,
                                Pakeitimu_aprasas = ?,
                                Deprecated = ?,
                                Atsisiuntimu_skaicius = ?,
                                Zyme = ?,
                                Eksperimentine = ?,
                                Stabilumo_lygis = ?
                            WHERE id = ? AND fk_Biblioteka = ?',
                            [
                                $version['Versija'],
                                $version['Pakeitimu_aprasas'],
                                $version['Pasenusi'],
                                $version['Atsisiuntimu_skaicius'],
                                $version['Zyme'],
                                $version['Eksperimentine'],
                                $version['Stabilumo_lygis'],
                                $version['id'],
                                $libraryId
                            ]
                        );
                    } else {
                        DB::delete('
                            DELETE FROM Versijos
                            WHERE id = ? AND fk_Biblioteka = ?',
                            [$version['id'], $libraryId]
                        );
                    }
                }
            }

            return redirect("/libraries/$libraryId");
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Library update failed: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->withErrors(['error' => 'Failed to update library: ' . $e->getMessage()]);
        }
    }

    public function filter()
    {
        return view('filter');
    }

    public function aggregate(Request $request)
    {
        $filters = $request->except('_token');

        $baseSql = "SELECT
                REPLACE(u.Slapyvardis, '_', ' ') AS Username,
                b.Pavadinimas AS LibraryName,
                b.Privati,
                b.Sukurimo_data AS CreationDate,
                COALESCE(COUNT(DISTINCT b.id), 0) AS MaintainedLibraryCount,
                SUM(IF(f.Dydis >= 0, f.Dydis, 0)) AS TotalFileSize,
                ROUND(COALESCE(AVG(f.Dydis), 0), 1) AS AverageFileSize,
                COALESCE(MAX(f.Atsisiuntimu_skaicius), 0) AS MaxSingleFileDownloads
            FROM
                Vartotojai u
            LEFT JOIN
                Bibliotekos_priziuretojas bp ON u.id = bp.fk_Vartotojas
            LEFT JOIN
                Bibliotekos b ON bp.fk_Biblioteka = b.id
            LEFT JOIN
                Failai f ON b.id = f.fk_Biblioteka
            :where_clause:
            GROUP BY
                u.id,
                Username DESC,
                LibraryName ASC,
                b.Privati,
                b.Sukurimo_data
            WITH ROLLUP;
        ";

        $whereClauses = [];
        $bindings = [];

        if (isset($filters['private']) && in_array($filters['private'], [0, 1])) {
            $whereClauses[] = "b.Privati = ?";
            $bindings[] = $filters['private'];
        }

        if (isset($filters['createdFrom'])) {
            $whereClauses[] = "b.Sukurimo_Data >= ?";
            $bindings[] = Carbon::make($filters['createdFrom'])->toDateTimeString();
        }

        if (isset($filters['createdTo'])) {
            $whereClauses[] = "b.Sukurimo_Data < ?";
            $bindings[] = Carbon::make($filters['createdTo'])->addDay()->toDateTimeString();
        }

        if (isset($filters['language']))
        {
            $whereClauses[] = "b.Kalba LIKE ?";
            $bindings[] = '%'.$filters['language'].'%';
        }

        $whereSql = "";
        if (!empty($whereClauses)) {
            $whereSql = "WHERE " . implode(" AND ", $whereClauses);
        }

        $finalSql = str_replace(':where_clause:', $whereSql, $baseSql);

        $aggregatedData = DB::select($finalSql, $bindings);

        return view('aggregate', ['aggregatedData' => Collection::make($aggregatedData)->groupBy(['Username', 'LibraryName'])]);
    }
}
