<!DOCTYPE html>
<html>

<head>
    <title>Congratulations</title>
</head>

<body>

    <p>Dear {{ $data['lname'] }},</p>

    @if ($data['award'] == '1')
        <p>Congratulations! You have been awarded a place on the Achiever's Award for Excellent Academic
            Performance for School Year 2022-2023.
        </p>
        <p>The Achiever's Award for Excellence Academic Performance acknowledges those who have achieved a semester
            General
            Weighted Average(GWA) of 1.75, or above, and with no grades lower than 2.50 in all subjects. </p>
        <p>A certificate is enclosed in recognition of your achievement. The Faculty takes great pride in acknowledging
            academic excellence and wishes you the best of luck for the future.
        </p>
    @elseif($data['award'] == '2')
        <p>Congratulations! You have been awarded a place on the Dean's List for Excellent Academic
            Performance for School Year 2022-2023.
        </p>
        <p>The Dean's List for Excellence Academic Performance acknowledges those who have achieved a semester General
            Weighted Average(GWA) of 1.51 to 1.75 and with no grades lower than 2.50 in all subjects. </p>
        <p>A certificate is enclosed in recognition of your achievement. The Faculty takes great pride in acknowledging
            academic excellence and wishes you the best of luck for the future.
        </p>
    @elseif($data['award'] == '3')
        <p>Congratulations! You have been awarded a place on the President's List for Excellent Academic
            Performance for School Year 2022-2023.
        </p>
        <p>The President's List for Excellence Academic Performance acknowledges those who have achieved a semester
            General
            Weighted Average(GWA) of 1.00 to 1.50 and with no grades lower than 2.50 in all subjects. </p>
        <p>A certificate is enclosed in recognition of your achievement. The Faculty takes great pride in acknowledging
            academic excellence and wishes you the best of luck for the future.
        </p>
    @elseif($data['award'] == '4')
        <p>Congratulations! You have been awarded a place on the Academic Excellence.
        </p>
        <p>The Academic Excellence for Excellence Academic Performance acknowledges those who have achieved a
            General Weighted Average(GWA) of 1.75 or above from 1st year to 4th year and with no grades lower than 2.50
            in all subjects. </p>
        <p>A certificate is enclosed in recognition of your achievement. The Faculty takes great pride in acknowledging
            academic excellence and wishes you the best of luck for the future.
        </p>
    @endif

</body>

</html>
