<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manual</title>
    <script src="https://kit.fontawesome.com/03ec1819cd.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body >
    <div class="container">
        <div class="row my-4">
            <h1 class="fw-bolder" fs-1">Barangay Management System Web Application User Guide</h1>
            <span>The provided guide and instruction is only available on this demo website, the actual system to be deployed has no manual page like this, I hope this will guide you on how the system works and give you idea on how will you properly used the web application.</span>
            <span>Note: The User Interface of the web app is designed and intended only  for desktop/computers or large screen only, it is not recommended to use on small devices such us phone.</span>
        </div>

        <div class="row justify-content-center mt-5">
            <span>
                <h4 class="fw-bolder">Login Page</h4>
                <p>1. First you need to login to access the system dashboard.</p>
            </span>
            <section>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/authenticate.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Login System</h5>
                        <p class="card-text">Login page has only two inputs for username and password, you need to have valid inputs for the system authentication, you will not access the dashboard if the authentication failed.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Username : <strong>User</strong></li>
                        <li class="list-group-item">Password : <strong>User12345678</strong></li>
                      </ul>
                </div>
            </section>
        </div>
        <div class="row justify-content-center mt-5" id="navigation">
            <span>
                <h4 class="fw-bolder">Dashboard Home Page</h4>
                <p>2. After a successful login you will be redirected in main dashboard.</p>
            </span>
            <section>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/nav.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Main Dashboard</h5>
                        <p class="card-text">In the main dashboard you can see the summary of the records, but let  focus on the navigation bar, the navbar will be used to redirect you to different pages and functionality of the system.</p>
                    </div>
                </div>
            </section>
        </div>
        <div class="row justify-content-center mt-5" id="profile">
            <span>
                <h4 class="fw-bolder">Profiles Page</h4>
                <p>3. Main Profile page section. Upon Inserting or adding data It will be good and I recommend to start adding the residents profile before proceeding adding families data. You will understand it why later on families part of the manual</p>
            </span>
            <section>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/profiles.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Resident Profiles</h5>
                        <p class="card-text">In the profiles page, you can add new profile, import and export profiles using excel, and see all the profile records in the database using the datatables. The datatables also provide search functions so you can easily find a specific records</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/addprofile.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Adding a profile</h5>
                        <p class="card-text">For adding a new profile click <strong>< Add New Resident Record ></strong> button then pop up form will be show up, you just need to fill up the form properly then add profile.</p>
                        <p>On filling up the form, the age will automatically computed when you input the birth date first.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/importprofile.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Import Profile</h5>
                        <p class="card-text">For importing profile you need to upload a excel or csv file to the system and will automatically create and store all the records on the database. Just click the <strong>< Choose File > </strong>button to select a file in your directory</p>
                        <p class="card-text"><strong>Note:</strong> For the excel file columns data must be similar to columns and data design in the database, or else it will cause conflict to the system. ( for customizing the record of the profile please don't hesitate to contact me. )</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/exportprofiles.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Export Profile Records</h5>
                        <p class="card-text">When Clicking the Export Profiles Button an pop up will be shown up to continue exporting the records just click the <strong>< Download It ></strong> button, and <strong>< Cancel ></strong> to cancel the export.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/profilesclick.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Selecting A Record</h5>
                        <p class="card-text">Selecting a specific record is easy just double click a specific row tiles in the datatables of chosen record and you will be redirected to another page to view the complete data</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="{{asset('images/Optimized/profilespage.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">View and Update Profile</h5>
                        <p class="card-text">In the view profile you will see the complete resident's data. On this page you can easily update the record just change the current data in the input fields then submit and the data will be updated. You can also delete the actual record by pressing the button <strong>< Delete ></strong></p>
                    </div>
                </div>
            </section>
        </div>

        {{-- families sections --}}
        <div class="row justify-content-center mt-5" id='families'>
            <span>
                <h4 class="fw-bolder">Families Page</h4>
                <p>4. I this page is where every family records is manage. Here is also were the residents is grouped by their families.</p>
            </span>
            <section>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/families.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Families Page</h5>
                        <p class="card-text">Main families Page. In this page you can see all the list and manage the families record on the database. Let say you already added all residents data and now you will be inputting families data on this page.</p>
                    </div>
                </div>
                <div class="card mb-3" id="addFam">
                    <img src="{{asset('images/Optimized/addfamily.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Add Family</h5>
                        <p class="card-text">Click the <strong>< Add New Family ></strong> button at the top part of the page to show up the pop up form.</p>
                        <p class="card-text">Selecting a specific record is easy just double click a specific row tiles in the datatables of chosen record and you will be redirected to another page to view the complete data.</p>
                    </div>
                    <ul class="list-group list-group-flush" >
                        <li class="list-group-item">To add family members just click the plus button, then a new input field will appear. As for Family Member Name if you already have all the resident data, it will automatically search and provide name options base from typed key words, you just need to click and select the name. <br><br> <strong>Note:</strong> If the family member name you type did not appear on option it means that there still no record in resident profiles and you CANNOT manually input the complete name of the family member it should be selected in option provided. <br>
                        <strong>Additionally </strong> - Incase the options is close just click the (opt or option button ) at the left side of the input field then the options will appear again</li>
                        <li class="list-group-item">To removed the input field for family members just click the trash button inline with the input field you want to remove.</li>
                        <li class="list-group-item">If the input field appear to have a border or color red it means error or there is no value provided upon submission.</li>
                      </ul>
                </div>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/familypage.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">View and Update Family</h5>
                        <p class="card-text">In this page you can access all the data of the family, update, and delete the data.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">You Can update the data by typing or change new values in the input fields click <strong>< save ></strong> then <strong>< Update Family ></strong></li>
                        <li class="list-group-item">(For Updating) a new family members just click the plus button, then a new input field will appear. As for Family Member Name if you already have all the resident data, it will automatically search and provide name options base from typed key words, you just need to click and select the name. <br><br> <strong>Note:</strong> If the family member name you type did not appear on option it means that there still no record in resident profiles and you CANNOT manually input the complete name of the family member it should be selected in option provided.</li>
                        <li class="list-group-item">(For Updating) To removed the input field for family members just click the trash button inline with the input field you want to remove. If you removed an existing member then it will be remove as a member of the family upon update.</li>
                        <li class="list-group-item">If the input field appear to have a border or color red it means error or there is no value provided upon submission.</li>
                        <li class="list-group-item">You can also delete the actual record by pressing the button <strong>< Delete ></strong></li>
                      </ul>
                </div>
            </section>
        </div>
        <div class="row justify-content-center mt-5" id="household">
            <span>
                <h4 class="fw-bolder">Household Page</h4>
                <p>5. I this page is where every Household records is manage. Here is also were the Families is grouped by Household.</p>
            </span>
            <section>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/household.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Main Household Page</h5>
                        <p class="card-text">Main Household Page. In this page you can see all the list and manage the Household record on the database. Let say you already added all families data and now you will be inputting the household data on this page.</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/householdadd.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Add Household</h5>
                        <p class="card-text">From Household main page click the <strong>< Add New Household ></strong> to show up the form</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">For selecting the household head, just type key word for name, like the previous input in families it will give you automatically the options. <br><br>
                            <strong>Note:</strong> The given options will be all the family members with just have a role of (Family Head and Solo Parent).
                        </li>
                        <li class="list-group-item">
                            For adding household members is just like adding family members, see <a href="#addFam" class="inline-block">Here</a>. after filling up the form just save and submit. <br>
                            Just make sure there is no red indicator in input fields for successful adding of records.
                        </li>
                      </ul>
                </div>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/householdpage.webp')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">View and Update Household</h5>
                        <p class="card-text">In this page you can access all the household information and you can also update them here.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                           The process of updating and deleting household are the same with the other pages.
                        </li>
                        <li class="list-group-item">
                           The only difference is the eye icon in the Household members, when you click this icon you will be redirected to specific family information.
                        </li>
                      </ul>
                </div>
            </section>
        </div>
        <div class="row justify-content-center mt-5" id="others">
            <span>
                <h4 class="fw-bolder">Other Admin Function</h4>
                <p>6. Lastly, In this section will be use for log out, backing up database, updating the admin password and username</p>
            </span>
            <section>
                <div class="card mb-3">
                    <img src="{{asset('images/Optimized/adminnav.webp')}}" class="card-img-top" alt="..." style="height: 300px; width: 250px">
                    <div class="card-body">
                        <h5 class="card-title">Others</h5>
                        <p class="card-text">On the bottom part of the nav, just click the <strong>< Admin ></strong> then it will show to more nav links.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Settings</strong> : the settings nav will redirect you to a new page where you update password and back-up the database.</li>
                        <li class="list-group-item"><strong>Sign Out</strong> : you will be logging out to the system and redirect to login page with this your access in the dashboard will be remove.</li>
                      </ul>
                </div>
            </section>
        </div>
        <div class="my-5 fs-2 fw-bold text-center">
            <a href={{route('base')}}>Continue to Demo Website</a>
        </div>
    </div>
</body>
</html>
