<?php

namespace KarimQaderi\ZoroasterFilemanager\Http\Services;

class FileTypesImages
{
    /**
     * @param $mime
     * @return mixed
     */
    public function getImage($mime)
    {
        if ($this->checkMime($mime, 'directory')) {
            return 'folder-2';
        }

        if ($this->checkMime($mime, 'pdf')) {
            return 'file-2';
        }

        if ($this->checkMime($mime, 'audio')) {
            return 'music';
        }

        if ($this->checkMime($mime, 'video')) {
            return 'video-2';
        }

        if ($this->checkMime($mime, 'zip') || $this->checkMime($mime, 'rar') || $this->checkMime($mime, 'octet-stream')) {
            return 'news';
        }

        if ($this->checkMime($mime, 'excel')) {
            return 'graph-bar';
        }

        if ($this->checkMime($mime, 'word') || $this->checkMime($mime, 'doc') || $this->checkMime($mime, 'docx')) {
            return 'file-2';
        }

        return 'file-2';
    }

    /**
     * Check if mime has type.
     *
     * @param   string  $mime
     * @param   string  $type
     *
     * @return  bool
     */
    private function checkMime($mime, $type)
    {
        if (str_contains($mime, $type)) {
            return true;
        }

        return false;
    }
}
