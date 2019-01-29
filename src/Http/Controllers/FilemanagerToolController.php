<?php

    namespace KarimQaderi\ZoroasterFilemanager\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use KarimQaderi\ZoroasterFilemanager\Http\Services\FileManagerService;

    class FilemanagerToolController extends Controller
    {
        /**
         * @var mixed
         */
        protected $service;

        /**
         * @param FileManagerService $filemanagerService
         */
        public function __construct(FileManagerService $filemanagerService)
        {
            $this->service = $filemanagerService;
        }

        public function index()
        {
            return view('Zoroaster-filemanager::tool');
        }

        /**
         * @param Request $request
         */
        public function getData(Request $request)
        {
//            return $this->service->ajaxGetFilesAndFolders($request);
            return view('Zoroaster-filemanager::getData')->with( $this->service->ajaxGetFilesAndFolders($request));
        }

        /**
         * @param Request $request
         */
        public function getFilemanager(Request $request)
        {
//            return $this->service->ajaxGetFilesAndFolders($request);
            return view('Zoroaster-filemanager::Filemanager')->with( $this->service->ajaxGetFilesAndFolders($request));
        }

        /**
         * @param Request $request
         */
        public function createFolder(Request $request)
        {
            if(empty($request->folder))
                return response()->json(['error' => 'لطفا یک نام برای پوشه انتخاب کنید']);

            return $this->service->createFolderOnPath( $request->folder, $request->current);
        }

        /**
         * @param Request $request
         */
        public function deleteFolder(Request $request)
        {
            return $this->service->deleteDirectory($request->current);
        }

        /**
         * @param Request $request
         */
        public function upload(Request $request)
        {
            return $this->service->uploadFile($request->file , $request->current);
        }

        /**
         * @param Request $request
         */
        public function getInfo(Request $request)
        {
//            dd($this->service->getFileInfo($request->file));
            return view('Zoroaster-filemanager::getInfo')->with((array)$this->service->getFileInfo($request->file));
        }

        /**
         * @param Request $request
         */
        public function removeFile(Request $request)
        {
            return $this->service->removeFile($request->file,$request->type);
        }


        /**
         * @param Request $request
         */
        public function rename(Request $request)
        {
            return $this->service->rename($request->file,$request->rename_file,$request->current);
        }
    }
