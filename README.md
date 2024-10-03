# Survey-System
A survey system wherein user/administrator can create different surveys, invite some users to fill these surveys, view status and reports of survey submissions.
Need to have a survey system wherein I can create different surveys, invite some users to fill these surveys, view status and reports of survey submissions.

1. Surveys can have all types of questions - single choice, multiple choice, comments, rating scales, compulsory, optional etc.
2. While inviting, invitation emails can be customized.
3. Each survey has a title, description.
4. Survey invites may or may not have an expiry date. Admin/creator can expire a survey any time.
5. Used surveys can be edited for adding new questions or deactivating certain questions. Once used, existing questions cannot be edited to maintain consistency of already received responses.
6. Administration options - Create Survey, Clone Survey, download report, invite users one-by-one, invite multiple from comma separated lists (CSV).
7. Reports have both tabular format and graphical representation wherever objective questions are involved.
   
Users:

Administrator/Author- Can create new users, can create and manage all surveys and reports data.
End-user/ Users submitting surveys- Can create new survey and manage their own created surveys and data.
Management- Can only view survey data and reports.


Database Tables:

Users- users
Survey Forms- survey infodata
Question Groups- question_groups
Questions / Question Types- questions
Options- options
Response- answers
Invitation- invitations

Screens:

Login
Dashboard
User Creation Screen 
User list
User Edit Screen
User Profile Screen (read-only) along with Edit Password.
Survey Form Creation Screen
View Survey/ Question Creation Screen
Survey Forms List
Survey Edit Screen
Question Group Creation Screen
Question Creation Screen
Question Edit Screen
Invitation Screen
Submission Report
Data Analysis Reports - Tabular/ Graphs / CSV Downloads

