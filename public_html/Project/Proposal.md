# Project Name: Simple Arcade Game
## Project Summary: This project will create a simple Arcade with scoreboards and competitions based on the implemented game.
## Github Link: https://github.com/lenahxo/IT202009/tree/prod/public_html/Project
## Project Board Link: https://github.com/lenahxo/IT202009/projects/1
## Website Link: https://ah682-prod.herokuapp.com/Project/login.php
## Your Name: Alen Holsey

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1
- [X] \(7 Oct 2021) User will be able to register a new account
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/register.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/8
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142447099-99f173c2-a205-4b9b-b775-8564e7344c08.png)
        - Screenshot #1 Server side validation for form fields
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142448013-84be5cfb-fc52-4e47-837c-bd1bf284281a.png)
        - Screenshot #2  User table; password (60 chars and hashed)
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/142450473-bc747bfc-8f66-48b0-8f09-c67ef60dfcfa.png)
        - Screenshot #3 Email should be unique
      - Screenshot #4 ![image](https://user-images.githubusercontent.com/56138268/142450960-e25c82cf-ccb8-44f2-ab1f-a5c2d8d19fb8.png)
        - Screenshot #4 Username should be unique

- [X] \(17 Nov 2021) User will be able to login to their account (given they enter the correct credentials)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/login.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/21
      - PR link #2 https://github.com/lenahxo/IT202009/pull/30
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142455148-1da8a133-26ba-4c37-b979-08d7e2755c8a.png)
        - Screenshot #1 Server side validation for login fields
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142458864-a5ae6600-a2d9-4a7a-bb8b-c458fdf246fd.png)
        - Screenshot #2 Friendly error message for account that doesn't exist
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/142459196-9c0680d7-bcc5-48e9-bcb3-5453a48194aa.png)
        - Screenshot #3 Friendly error message for incorrect password
      - Screenshot #4 ![image](https://user-images.githubusercontent.com/56138268/142460067-b683b292-5f5f-4da9-a57b-27bbf2f863a2.png)
      - Screenshot #5 ![image](https://user-images.githubusercontent.com/56138268/142461419-39bec3a3-0b0e-413b-b044-7f7aaf0f85b4.png)
        - Screenshot #4-#5 Server side fetching and saving details/roles and redirecting to landing page (home)

- [X] \(16 Oct 2021) User will be able to logout
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/24
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142463001-d0348955-7422-4b93-ab97-7d23f3125b78.png)
        - Screenshot #1 Server side redirection to login page and message of successful logout
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142465408-c8e3b385-d278-482c-bfdf-724db40d88da.png)
        - Screenshot #2 Redirection to login page; successful logout message not displaying
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/142466702-b8ea8d83-b0b9-4a77-8502-3469b0fed68b.png)
        - Screenshot #3 Session destroyed; friendly message displays after hitting the back button once logged out

- [X] \(27 Oct 2021) Basic security rules implemented
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/home.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/21
      - PR link #2 https://github.com/lenahxo/IT202009/pull/26
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142471104-fb737a48-b113-4638-b3c3-f974d85d9688.png)
        - Screenshot #1 Server side security function: check if user is logged in
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142470184-43a68793-b8f1-48b1-a052-dd887f3ff68c.png)
        - Screenshot #2 Roles table

- [X] \(27 Oct 2021) Basic Roles implemented
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/admin/list_roles.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/26
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142470184-43a68793-b8f1-48b1-a052-dd887f3ff68c.png)
        - Screenshot #1 Roles table
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142471960-1ed7a887-7ee5-46ba-a0b4-c5661b6d0320.png)
        - Screenshot #2 User roles table
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/142472421-89fcdc43-34e6-49b1-936c-e4ed241dee63.png)
        - Screenshot #3 Server side check for specific user role

- [X] \(17 Nov 2021) Site should have basic styles/theme applied; everything should be styled
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/issues/17
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142473147-496accbf-05cf-43fc-98fa-3085f7881ca1.png)
        - Screenshot #1 Basic style and theme

- [X] \(16 Oct 2021) Any output messages/errors should be “user friendly”
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/login.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/21
      - PR link #2 https://github.com/lenahxo/IT202009/pull/24
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142459196-9c0680d7-bcc5-48e9-bcb3-5453a48194aa.png)
        - Screenshot #1 Friendly error message for incorrect password
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142466702-b8ea8d83-b0b9-4a77-8502-3469b0fed68b.png)
        - Screenshot #2 Session destroyed; friendly message displays after hitting the back button once logged out

- [X] \(27 Oct 2021) User will be able to see their profile
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/27
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142477933-a5b8b41d-febd-4951-ac86-9cc7f9660593.png)
        - Screenshot #1 User profile
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/145698559-95b08952-b8df-4249-b80c-11bb37276edf.png)
        - Screenshot #1 Scores table

- [X] \(27 Oct 2021) User will be able to edit their profile
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/27
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/142478759-90a96a66-ef95-4837-b0f7-c14ff869fe62.png)
        - Screenshot #1 Friendly message display upon check for changed username availability
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/142479544-31ca9859-1c65-4164-87fe-2aeb30868553.png)
        - Screenshot #2 Validation check for email
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/142480055-158dcb02-7607-41d2-b6f8-2fbb4dd4b80e.png)
      - Screenshot #4 ![image](https://user-images.githubusercontent.com/56138268/142480178-ba480b9d-cb8b-4485-983d-4e73c95a1966.png)
        - Screenshot #3-#4 Does not allow password change without current password provided, but does not display friendly message to user


- Milestone 2
- [X] \(3 Dec 2021) Pick a simple game to implement
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: N/A
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/69
    - Issues Link
      - Issues link #1 https://github.com/lenahxo/IT202009/issues/41
    - Screenshots
      - Screenshot #1 N/A
        - Screenshot #1 N/A

- [X] \(11 Dec 2021) The system will save the user’s score at the end of the game if the user is logged in
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: N/A
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/69
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/145698323-bdeb3700-c242-484b-9098-6b133b140879.png)
        - Screenshot #1 User log in check to save score

- [X] \(3 Dec 2021) The user will be able to see their last 10 scores
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://ah682-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/69
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/145698402-b8e51f2a-0020-4f00-8d56-b40fd828cb8b.png)
        - Screenshot #1 Last 10 scores listed on user's profile
      - Screenshot #2 ![image](https://user-images.githubusercontent.com/56138268/145698433-6d890a51-1f7a-454f-bfba-266c7efc4b0a.png)
        - Screenshot #2 Code to display on profile
      - Screenshot #3 ![image](https://user-images.githubusercontent.com/56138268/145698461-742ed287-d90b-4a36-9dd8-972db5df4116.png)
        - Screenshot #3 Code for function to display latest 10 scores

- [X] \(3 Dec 2021) Create functions that output the following scoreboards (this will be used later)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: N/A
    - Pull Requests
      - PR link #1 https://github.com/lenahxo/IT202009/pull/69
    - Screenshots
      - Screenshot #1 ![image](https://user-images.githubusercontent.com/56138268/145698507-530a7777-f2c4-4d7a-8140-8324660124c1.png)
        - Screenshot #1 Code for top 10 weekly, monthly, and lifetime scores

- Milestone 3
- [X] \(18 Dec 2021) Users will have points associated with their account
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [X] \(18 Dec 2021) Create a PointsHistory table (id, user_id, point_change, reason, created)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [X] \(18 Dec 2021) Competitions table should have the following columns 
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [ ] \(22 Dec 2021) User will be able to create a competition
  -  List of Evidence of Feature Completion
    - Status: Partially Working (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [ ] \(mm/dd/yyyy of completion) Each new participant causes the Reward value to increase by at least 1 or 50% of the joining fee rounded up
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [ ] \(mm/dd/yyyy of completion) Have a page where the User can see active competitions (not expired)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [X] \(18 Dec 2021) Will need an association table CompetitionParticipants (id, comp_id, user_id, created)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [ ] \(mm/dd/yyyy of completion) User can join active competitions
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- [ ] \(mm/dd/yyyy of completion) Create function that calculates competition winners
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show

- Milestone 4
### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board