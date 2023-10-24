<title>Report</title>
<style>
    .information-user{
        background-color: hsl(0deg 0% 100%);
        /* height: 200px; */
        padding: 2rem;
        border-radius: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .user-image{
        width: 100px;
    }
</style>
<div>
    <h3>Report Attendence For :{{$user->name}} Month : {{$date}}</h3>
    <section class="information-user">
        <div class="user-image">
            <img src={{$user->image ? $user->image : "https://cdn-icons-png.flaticon.com/512/3616/3616930.png"}} alt="">
        </div>
        <div>
            <div class="user-name">
                <h4>Employee Name :{{$user->name}}</h4>
            </div>
            <div class="company-name">
                <h4>Company Name :{{$user->company_name}}</h4>
            </div>
        </div>
        <div>
            <div class="department-name">
                <h4>Department Name :{{$user->department_name}}</h4>
            </div>
            <div class="user-position">
                <h4>Position :{{$user->position}}</h4>
            </div>
        </div>


    </section>
</div>
