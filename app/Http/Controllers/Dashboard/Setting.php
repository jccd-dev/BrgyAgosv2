<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Routing\Controller;
use Spatie\DbDumper\Databases\MySql;
use Symfony\Component\HttpFoundation\StreamedResponse;
class Setting extends Controller{

    public function backUpDatabase(){
        $databaseName = config('database.connections.mysql.database');
        $fileName = $databaseName . '-' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/' . $fileName);

        // Construct the mysqldump command
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            $databaseName,
            $filePath
        );

        // Execute the mysqldump command
        exec($command);

        // Check if the backup file was created
        if (file_exists($filePath)) {
            // Prepare the file for download
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ];

            // Delete the file after download
            register_shutdown_function(function () use ($filePath) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            });

            // Return the file download response
            return response()->download($filePath, $fileName, $headers);
        }

        // If the backup file doesn't exist, handle the error accordingly
        abort(404, 'Database backup not found.');
    }
}
