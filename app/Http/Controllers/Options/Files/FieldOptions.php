<?php 

namespace App\Http\Controllers\Options\Files;

class FieldOptions{

    public $fieldOptions = [];

    public function getFieldOptions(){

        $this->fieldOptions["Calendar Hour Format:calendar_hour_format"] = "Format:yyyy-mm-dd ,mm-dd-yyyy ,dd-mm-yyyy";
        $this->fieldOptions["Calander View:default_calendar_view"] = "Calander View:Today,This Week,This Month,This Year";
        $this->fieldOptions["Event Status:default_event_status"] = "Event Status:Planned,Held,Not Held";
        $this->fieldOptions["Event Duration:other_event_duration_mins"] = "Event Duration:5,10,30,120";
        $this->fieldOptions["Priorities for tickets:Ticket Priorities"] = "Ticket Priorities:Low,Medium,High,Urgent";
        $this->fieldOptions["Status for tickets:Ticket Status"] = "Ticket Status:Open,In Progress, Wait For Response,Done,Closed";
        $this->fieldOptions["Severity for tickets:Ticket Severity"] = "Ticket Severity:Major,Minor,Feature,Critical";
        $this->fieldOptions["Types for tickets:Ticket Types"] = "Ticket Types:Sales,Website Support,Mobile Application Support,Customer Support,Other Technical,Bugs";
        $this->fieldOptions["Category for tickets:Ticket Category"] = "Ticket Category:Big Problem, Small Problem, Other Problem";
        $this->fieldOptions['document_status:Account Document Status'] = "Account Document Status:Approved, Not Approved";
        $this->fieldOptions["sector:Sector"] = "Sector:Shia, Sunni, Wahabi";
        $this->fieldOptions["deaf_members_identity:Identity For Deaf Members"] = "Identity For Deaf Members:Hearing, Deaf, Hard of hearing";
        $this->fieldOptions["communication_for_deaf_members:Source Of Communication For Deaf Members"] = "Communication For Deaf Members:Oral, British Sign Language, American Sign Language, Pakistan Sign Language, Other Sign Language";
        $this->fieldOptions["membership_plans:Types Of Membership Plans"] = "Types Of Membership Plans:Price, Duration, Expiry Date, Message Send Limit";
        $this->fieldOptions["member_general_settings:General Settings For Members"] = "0:Hide Profile, Empower Feature, Push Notifications, Chat Preview";
        $this->fieldOptions["admin_general_settings:General Settings For Admin"] = "0:Photos Count, Free Trial Expiration, Come Back To DeenMatch Notification, OTP per day limit, New User Tag";
        $this->fieldOptions["profile_status:Profile Status For Member"] = "Profile Status For Member:Pending, Accepted, Rejected";
        $this->fieldOptions["account_state:Member Account State"] = "Member Account State:Active, Inactive";
        $this->fieldOptions["member_ethnicity:Member Ethnicity"] = "Member Ethnicity:Asian, European";
        $this->fieldOptions["interests:Member Interests"] = "Member Interest:Fashion, Instagram, Style, Art, Drawing, Peotry";
        $this->fieldOptions["relationship_questions:Relationship Questions"] = "Relationship Questions:What is your marital status, When is your ideal time for marriage, Do you have children?, Would you move abroad for marriage?";
        $this->fieldOptions["appearance and habbits:Appearance And Habits Questions"] = "Appearance And Habits Questions:What is your height?, Do you smoke?";
        $this->fieldOptions['countries:Countries'] = "Countries:Afghanistan, Unknown, Aland Islands, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, Antarctica, Antigua and Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Bouvet Island, Brazil, British Indian Ocean Territory, Brunei Darussalam, Bulgaria, Burkina Faso, Burundi, Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, Chad, Chile, China, Colombia, Comoros, Congo, Cook Islands, Costa Rica, Cote D'Ivoire, Croatia, Cuba, Cyprus, Czech Republic, Denmark, Djibouti, Dominica, Dominican Republic, Ecuador, Egypt, El Salvador, Equatorial Guinea, Eritrea, Estonia, Ethiopia, Falkland Islands (Malvinas), Faroe Islands, Fiji, Finland, France, French Guiana, French Polynesia, Gabon, Gambia, Georgia, Germany, Ghana, Gibraltar, Greece, Greenland, Grenada, Guadeloupe, Guam, Guatemala, Guernsey, Guinea, Guinea-Bissau, Guyana, Haiti, Heard Island and McDonald Islands, Holy See (Vatican City State), Honduras, Hong Kong, Hungary, Iceland, India, Indonesia, Iran, Iraq, Ireland, Isle of Man, Israel, Italy, Jamaica, Japan, Jersey, Jordan, Kazakstan, Kenya, Kiribati, Korea Democratic People'S Republic Of, Korea, Kuwait, Kyrgyzstan, Lao People'S Democratic Republic, Latvia, Lebanon, Lesotho, Liberia, Libyan Arab Jamahiriya, Liechtenstein, Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malawi, Malaysia, Maldives, Mali, Malta, Marshall Islands, Martinique, Mauritania, Mauritius, Mayotte, Mexico, Micronesia, Moldova, Monaco, Mongolia, Montserrat, Morocco, Mozambique, Myanmar, Namibia, Nauru, Nepal, Netherlands, Netherlands Antilles, New Caledonia, New Zealand, Nicaragua, Niger, Nigeria, Niue, Norfolk Island, Northern Mariana Islands, Norway, Oman, Pakistan, Palau, Palestinian Territory, Occupied, Panama, Papua New Guinea, Paraguay, Peru, Philippines, Poland, Portugal, Puerto Rico, Qatar, Reunion, Romania, Russian Federation, Rwanda, Saint Lucia, Saint Pierre and Miquelon, Saint Vincent and the Grenadines, Samoa, San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Serbia, Seychelles, Sierra Leone, Singapore, Slovakia, Slovenia, Solomon Islands, Somalia, South Africa, Spain, Sri Lanka, Sudan, Suriname, Svalbard and Jan Mayen, Swaziland, Sweden, Switzerland, Syrian Arab Republic, Taiwan, Tajikistan, Tanzania, Thailand, Togo, Tokelau, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Turks and Caicos Islands, Tuvalu, Uganda, Ukraine, United Arab Emirates, United Kingdom, United States, United States Minor Outlying Islands, Uruguay, Uzbekistan, Vanuatu, Venezuela, Vietnam, Virgin Islands, British, Virgin Islands, U.S., Wallis and Futuna, Western Sahara, Yemen, Zambia, Zimbabwe";

        $this->fieldOptions["occupation_questions:Occupation Questions"] = "Occupation Questions:What is your highest level of education, What do you do for a living?, Question 3";
        $this->fieldOptions["religion_questions:Religion Questions"] = "Religion Questions:How religious are you?, How often do you pray?, Do you only eat halal?, Do you drink alcohol?, Are you a revert?, Are you a Sayyid?";
        $this->fieldOptions["occupation:Member Occupation"] = "Member Occupation:Actor, Actuary, Blacksmith, Chef, Optician";
        $this->fieldOptions["height:Height"] = "Height:122cm, 150cm, 190cm, 200cm, 241cm";
        $this->fieldOptions["marital_status:Martial Status"] = "Marital Status:Never Married, Divorced, Seperated, Annulled, Widow";
        $this->fieldOptions["marital_time:Marital Time"] = "Marital Time:Unsure, As soon as possible, 1-2 Years, 3-4 Years, 4+ Years";
        $this->fieldOptions["education:Education"] = "Education:Secondary School, College, Doctorate, Non Degree Qualification, Masters Degree, Bachelors Degree, Other";
        $this->fieldOptions["religiosity:Religiosity"] = "Religiosity:Very Practising, Practising, Moderately Practising, Not Practising";
        $this->fieldOptions["halal_food:Halal Food"] = "Halal Food:Only Eats Halal, Doesn't Eat Halal";
        $this->fieldOptions["smokes:Smokes"] = "Smokes:Smokes, Doesn't Smokes";
        $this->fieldOptions["ehnicity_questions:Ethnicity Questions"] = "Ethnicity Questions:What's your ethnic group?, Question 2, Question 3";
        $this->fieldOptions["have_children:Have Children"] = "Have Children:Have Children, Doesn't Have Children";
        $this->fieldOptions["offer_prayers:Offer Prayers"] = "Offer Prayers:Always Pray, Usually Prays, Moderately Prays, Never Prays";
        $this->fieldOptions["drinks_alcohol:Drinks Alcohol"] = "Drinks Alcohol:Doesn't Drink Alcohol, Drinks Alcohol";
        $this->fieldOptions['profile_phases:Profile Phases'] = "Profile Phases:Sign Up,Personal Information ,Questions and Answers";
        $this->fieldOptions['revert:Convert/Revert'] = "Convert/Revert:Convert, Revert";
        $this->fieldOptions['is_sayyid:Is Sayyid'] = "Is Sayyid:Sayyid, Not a Sayyid";
        $this->fieldOptions['move_abroad:Would Move Abroad'] = "Would Move Abroad:Would Move Abroad, Would Not Move Abroad";
        $this->fieldOptions['questions_for_females:Questions For Females'] = "Questions For Females:How do you dress?";
        $this->fieldOptions['dressing:dressing'] = "Dressing:Modest, Hijab, Jibab, Niqab, None";
        $this->fieldOptions['advice_for_males:Advice For Males'] = "Advice For Males:In the same way as Khadija sent a marriage proposal to Prophet Muhammed; We empower women to make the first move.";
        $this->fieldOptions['advice_for_females:Advice For females'] = "Advice For Females:Men will not be able to message you. When you match with another member you have 24 hours to send a message first.";
        $this->fieldOptions['interest_questions:Interest Questions'] = "Interest Questions:Choose your top 5 interests";

        return $this->fieldOptions;
    }
}


?>