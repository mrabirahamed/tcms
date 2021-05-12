<?php

class errorController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($code = FALSE)
    {
        $message = $this->_getError($code);
        $this->view->setJs(['main']);
        $this->view->assign('title', $message['Message']);
        $this->view->assign('message', $message);

        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => $message['Message'])));
        $this->view->render('index');
    }

    public function access($code)
    {
        $message = $this->_getError($code);
        $this->view->setJs(['main']);
        $this->view->assign('title', $message['Message']);
        $this->view->assign('message', $message);
        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => $message['Message'])));
        $this->view->render('access');
    }

    private function _getError($code = FALSE)
    {
        if ($code) {
            $code = $this->filterInt($code);
            if (is_int($code)) {
                $code = $code;
            }
        } else {
            $code = 'default';
        }

        /*default message*/
        $error['default']['Message'] = 'An uncaught error';
        $error['default']['Description'] = 'There are may be an occur. As soon as we solve it. Thank you for with us.';

        /*1xx: Information*/
        $error['100']['Message'] = 'Continue';
        $error['100']['Description'] = 'The server has received the request headers, and the client should proceed to send the request body.';

        $error['101']['Message'] = 'Switching Protocols';
        $error['101']['Description'] = 'The requester has asked the server to switch protocols.';

        $error['103']['Message'] = 'Checkpoint';
        $error['103']['Description'] = 'Used in the resumable requests proposal to resume aborted PUT or POST requests.';

        /*2xx: Successful*/
        $error['200']['Message'] = 'OK';
        $error['200']['Description'] = 'Used in the resumable requests proposal to resume aborted PUT or POST requests.';

        $error['201']['Message'] = 'Created';
        $error['201']['Description'] = 'The request has been fulfilled, and a new resource is created.';

        $error['202']['Message'] = 'Accepted';
        $error['202']['Description'] = 'The request has been accepted for processing, but the processing has not been completed.';

        $error['203']['Message'] = 'Non-Authoritative Information';
        $error['203']['Description'] = 'The request has been successfully processed, but is returning information that may be from another source.';

        $error['204']['Message'] = 'No Content';
        $error['204']['Description'] = 'The request has been successfully processed, but is not returning any content.';

        $error['205']['Message'] = 'Reset Content';
        $error['205']['Description'] = 'The request has been successfully processed, but is not returning any content, and requires that the requester reset the document view.';

        $error['206']['Message'] = 'Partial Content';
        $error['206']['Description'] = 'The server is delivering only part of the resource due to a range header sent by the client.';

        /*3xx: Redirection*/
        $error['300']['Message'] = 'Multiple Choices';
        $error['300']['Description'] = 'A link list. The user can select a link and go to that location. Maximum five addresses.';

        $error['301']['Message'] = 'Moved Permanently';
        $error['301']['Description'] = 'The requested page has moved to a new URL.';

        $error['302']['Message'] = 'Found';
        $error['302']['Description'] = 'The requested page has moved temporarily to a new URL.';

        $error['303']['Message'] = 'See Other';
        $error['303']['Description'] = 'The requested page can be found under a different URL.';

        $error['304']['Message'] = 'Not Modified';
        $error['304']['Description'] = 'Indicates the requested page has not been modified since last requested.';

        $error['306']['Message'] = 'Switch Proxy';
        $error['306']['Description'] = 'No longer used.';

        $error['307']['Message'] = 'Temporary Redirect';
        $error['307']['Description'] = 'The requested page has moved temporarily to a new URL.';

        $error['308']['Message'] = 'Resume Incomplete';
        $error['308']['Description'] = 'Used in the resumable requests proposal to resume aborted PUT or POST requests.';

        /*4xx: Client Error*/
        $error['400']['Message'] = 'Bad Request';
        $error['400']['Description'] = 'The request cannot be fulfilled due to bad syntax.';

        $error['401']['Message'] = 'Unauthorized';
        $error['401']['Description'] = 'The request was a legal request, but the server is refusing to respond to it. For use when authentication is possible but has failed or not yet been provided.';

        $error['402']['Message'] = 'Payment Required';
        $error['402']['Description'] = 'You must be pay us to use this service.';

        $error['403']['Message'] = 'Forbidden';
        $error['403']['Description'] = 'The request was a legal request, but the server is refusing to respond to it.';

        $error['404']['Message'] = 'Not Found';
        $error['404']['Description'] = 'The requested page could not be found but may be available again in the future.';

        $error['405']['Message'] = 'Method Not Allowed';
        $error['405']['Description'] = 'A request was made of a page using a request method not supported by that page.';

        $error['406']['Message'] = 'Not Acceptable';
        $error['406']['Description'] = 'The server can only generate a response that is not accepted by the client.';

        $error['407']['Message'] = 'Proxy Authentication Required';
        $error['407']['Description'] = 'The client must first authenticate itself with the proxy.';

        $error['408']['Message'] = 'Request Timeout';
        $error['408']['Description'] = 'The server timed out waiting for the request.';

        $error['409']['Message'] = 'Conflict';
        $error['409']['Description'] = 'The request could not be completed because of a conflict in the request.';

        $error['410']['Message'] = 'Gone';
        $error['410']['Description'] = 'The requested page is no longer available.';

        $error['411']['Message'] = 'Length Required';
        $error['411']['Description'] = 'The "Content-Length" is not defined. The server will not accept the request without it.';

        $error['412']['Message'] = 'Precondition Failed';
        $error['412']['Description'] = 'The precondition given in the request evaluated to false by the server.';

        $error['413']['Message'] = 'Request Entity Too Large';
        $error['413']['Description'] = 'The server will not accept the request, because the request entity is too large .';

        $error['414']['Message'] = 'Request-URI Too Long';
        $error['204']['Description'] = 'The server will not accept the request, because the URL is too long. Occurs when you convert a POST request to a GET request with a long query information.';

        $error['415']['Message'] = 'Unsupported Media Type';
        $error['415']['Description'] = 'The server will not accept the request, because the media type is not supported.';

        $error['416']['Message'] = 'Requested Range Not Satisfiable';
        $error['416']['Description'] = 'The client has asked for a portion of the file, but the server cannot supply that portion.';

        $error['417']['Message'] = 'Expectation Failed';
        $error['417']['Description'] = 'The server cannot meet the requirements of the Expect request-header field.';

        /*5xx: Server Error*/
        $error['500']['Message'] = 'Internal Server Error';
        $error['500']['Description'] = 'A generic error message, given when no more specific message is suitable.';

        $error['501']['Message'] = 'Not Implemented';
        $error['501']['Description'] = 'The server either does not recognize the request method, or it lacks the ability to fulfill the request.';

        $error['502']['Message'] = 'Bad Gateway';
        $error['502']['Description'] = 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.';

        $error['503']['Message'] = 'Service Unavailable';
        $error['503']['Description'] = 'The server is currently unavailable (overloaded or down) .';

        $error['504']['Message'] = 'Gateway Timeout';
        $error['504']['Description'] = 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.';

        $error['505']['Message'] = 'HTTP Version Not Supported';
        $error['505']['Description'] = 'The server does not support the HTTP protocol version used in the request .';

        $error['511']['Message'] = 'Network Authentication Required';
        $error['511']['Description'] = 'The client needs to authenticate to gain network access.';

        $error['8080']['Message'] = 'Session Time out.';
        $error['8080']['Description'] = 'Session Time out.';


        if (array_key_exists($code, $error)) {
            return $error[$code];
        } else {
            return $error['default'];
        }
    }
}
