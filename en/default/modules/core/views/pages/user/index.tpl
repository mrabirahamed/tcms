<style>
    .userProfileCover {
        height: 200px;
        position: relative;
        text-align: center;
        color: #fff;
    }

    .userProfileCover img {
        width: 100%;
        height: 100%;
    }

    .userProfileCoverPhotoChanger {
        top: 8px;
        left: 16px;
        text-align: left;
        position: absolute;
    }

    .userProfileCoverPhotoChanger label {
        padding: 2px 6px;
        width: 26px;
        height: 18px;
        color: black;
        background: white;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
    }

    .userProfileCoverPhotoChanger label:hover {
        width: 150px;
    }

    .userProfileCoverCaption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .userProfilePicture {
        position: absolute;
        bottom: -30px;
        left: 13px;
    }

    .userFullName {
        font-size: 40px;
        font-weight: bold;
        bottom: 10px;
        left: 180px;
        position: absolute;
    }

    .userFullName a {
        color: white;
    }

    .userProfilePicture img {
        width: 160px;
        height: 160px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .userProfileAdvanceMenu {
        position: absolute;
        bottom: 8px;
        right: 16px;
    }

    .userProfileAdvanceMenuItem {
        list-style: none;
        display: block;
        float: right;
        background: white;
    }

    .userProfileAdvanceMenuItem li {
        padding: 10px 20px;
        display: inline-block;
        border-left: 2px solid lightgrey;
    }

    .userProfileAdvanceMenuItem li a {
        margin: 0;
        padding: 0;
        color: black;
        font-size: 16px;
        font-weight: bold;
    }

    .userProfileAdvanceMenuItem li:hover {
        background-color: deepskyblue;
    }

    .userProfileAdvanceMenuItem li a:hover {
        color: white;
    }

    .userProfileMenuBar {
        width: 100%;
        height: 37px;
        -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
    }

    ul.userProfileMenu {
        list-style: none;
        display: block;
        float: right;
    }

    ul.userProfileMenu li {
        padding: 10px 20px;
        display: inline-block;
        border-left: 2px solid lightgrey;
    }

    ul.userProfileMenu li a {
        margin: 0;
        padding: 0;
        color: black;
        font-size: 15px;
        font-weight: bold;
    }

    ul.userProfileMenu li:hover {
        background-color: deepskyblue;
    }

    ul.userProfileMenu li:hover > ul.userProfileMenu li a {
        color: white;
    }

    ul.userProfileMenu li a:hover {
        color: white;
    }

    .UserAreaShadow {
        -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
    }

    ul.userShortDescription {
        list-style: none;
        display: block;
    }

    ul.userShortDescription li {
        padding: 7px 15px
    }
</style>

<div class="row">
    <div class="userProfileCover">
        <img src="{$layoutParams.publicIMG}img_lights.jpg" alt="Profile cover photo">
        <div class="userProfileCoverPhotoChanger">
            <label>
                <input type="checkbox" style="display: none"/>
                <i class="fa fa-camera" title="Change your cover photo"></i> Change cover photo
            </label>
        </div>
        {*<div class="userProfileCoverCaption">Welcome to my profile</div>*}
        <div class="userProfilePicture">
            <img src="{$layoutParams.publicIMG}img_avatar3.png">
        </div>
        <div class="userFullName">
            <a href="{$layoutParams.root}user/profile/{preg_replace('/msu_/is', '$1', Session::get('username'))}">{$user.f_name}
                &nbsp;{$user.l_name}</a>
        </div>
        <div class="userProfileAdvanceMenu">
            <ul class="userProfileAdvanceMenuItem">
                <li><a href="#">Edit My Profile</a></li>
                <li><a href="#">Activity Log</a></li>
            </ul>
        </div>
    </div>

    <div class="userProfileMenuBar">
        <ul class="userProfileMenu">
            <li><a href="#">Timeline</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Friends</a></li>
            <li><a href="#">Photos</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">More</a></li>
        </ul>
    </div>
    <div class="col-lg-plus-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xs-plus-12">
        <div class="col-lg-plus-4 col-lg-4 col-md-3">
            <div class="UserAreaShadow">
                <ul class="userShortDescription">
                    <li><i class="fa fa-university"></i> CEO at Mishu software inc.</li>
                    <li><i class="fa fa-home"></i> Live in Jessore</li>
                    <li><i class="fa fa-home"></i> Frome Jessore</li>
                    <li><i class="fa fa-male"></i> Married</li>
                    <li><i class="fa fa-flag"></i> Followed by 14M people</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-plus-8 col-lg-8 col-md-9 col-sm-12 col-xs-12 col-xs-plus-12">

            <div class="col-lg-plus-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xs-plus-12 newPost UserAreaShadow">
                <div class="col-lg-plus-2 col-lg-2 col-md-2">Title</div>
                <div class="col-lg-plus-10 col-lg-10 col-md-10"><input type="text" class="input-control"/></div>
                <div class="col-lg-plus-2 col-lg-2 col-md-2">Content</div>
                <div class="col-lg-plus-10 col-lg-10 col-md-10"><textarea class="input-control"></textarea></div>
                <input type="submit" class="button button-primary float-right"/>
            </div>

            <div class="col-lg-plus-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xs-plus-12 OLDPost UserAreaShadow">
                <div class="postHeader">
                    <div class="postUserProfilePhoto"></div>
                </div>
                <p>Terabyte (TB) is a digital information measurement unit which is going to be extensively used in the
                    nearest future for measuring the size of computer RAM, etc., but now it is used for measuring the
                    amount of digital information in online libraries, digital archives, and so on. 1 terabyte is equal
                    to 1000 gigabytes, or 1012 bytes. However, in terms of information technology or computer science, 1
                    TB is 240 or 10244 bytes, which is equal to 1,099,511,627,776 bytes.</p>
            </div>
        </div>
    </div>
</div>
