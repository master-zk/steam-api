<?php

declare(strict_types=1);

namespace app\bundles\system\controller\common;

use app\api\employee\controller\BaseController;
use app\bundles\system\request\common\FileUploadRequest;
use app\bundles\system\request\common\FileUrlRequest;
use app\bundles\system\response\common\FileUploadResponse;
use app\bundles\system\response\common\FileUrlResponse;
use app\bundles\system\service\FileService;
use app\exception\CustomException;
use Flame\Filesystem\Storage;
use Flame\Http\Response;
use Flame\Http\UploadedFile;
use Flame\Support\Facade\Log;
use OpenApi\Attributes as OA;

class FileController extends BaseController
{
    protected array $except = [
        '*',
    ];

    #[OA\Post(path: '/api/system/common/file/upload', summary: '附件上传接口', security: [['bearerAuth' => []]], tags: ['附件管理'])]
    #[OA\RequestBody(
        required: true,
        content: [
            new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(ref: FileUploadRequest::class)
            ),
        ]
    )]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: FileUploadResponse::class))]
    public function upload(): Response
    {
        try {
            $v = new FileUploadRequest;
            if (! $v->check($this->file())) {
                throw new CustomException($v->getError());
            }

            // 获取表单上传文件
            /** @var UploadedFile $file */
            $file = $this->file('file');
            $newFilename = hash_file('md5', $file->path()).'.'.$file->getClientOriginalExtension();
            $fileNames = ['call-center', 'upload', $this->userId, $newFilename];
            $fileName = implode('/', $fileNames);

            // 转存到OSS
            $storage = new Storage;
            $storage->upload($fileName, $file->getPathname());

            $uploadResponse = new FileUploadResponse;
            $uploadResponse->setUrl($storage->url($fileName));
            $uploadResponse->setName($file->getClientOriginalName());

            return $this->success($uploadResponse->toArray());
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);
            dd($e);

            return $this->fail('附件上传错误');
        }
    }

    #[OA\Post(path: '/api/system/common/file/url', summary: '获取附件url', security: [['bearerAuth' => []]], tags: ['附件管理'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: FileUrlRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: FileUrlResponse::class))]
    public function url(): Response
    {
        try {
            $request = $this->requestBody();
            $v = new FileUrlRequest;
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            // 获取 OSS url
            $filepath = $request['path'];
            $storage = new Storage;
            $uploadResponse = new FileUrlResponse;
            $uploadResponse->setUrl($storage->url($filepath));

            return $this->success($uploadResponse->toArray());
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);

            return $this->fail('获取附件url错误');
        }
    }

    #[OA\Post(path: '/api/system/common/file/txtToAudio', summary: '文本转语音', security: [['bearerAuth' => []]], tags: ['附件管理'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: FileUrlRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: FileUrlResponse::class))]
    public function txtToAudio(): Response
    {
        try {
            $request = $this->requestBody();
            $v = new FileUrlRequest;
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            // 获取 OSS url
            $filepath = $request['path'];
            $storage = new Storage;
            $uploadResponse = new FileUrlResponse;
            if (! $storage->isExists($filepath)) {
                return $this->fail('文本文件不存在');
            }

            $service = new FileService;
            $audioUrl = $service->getAudioUrl($filepath);
            $audioUrl = $storage->url($audioUrl);
            $uploadResponse->setUrl($audioUrl);

            return $this->success($uploadResponse->toArray());
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error("txtToAudioThrowable: {$e->getMessage()}:{$e->getTraceAsString()}");

            return $this->fail('文本转语音失败');
        }
    }
}
