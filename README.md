## OBS this project is running under PHP ^8.4

## Steps to run the project

1. Unzip or Clone the project
2. copy `.env.example` to `.env`
3. fill the environment variables in `.env` file
4. Run `composer install`
5. Run `php -S localhost:8000 -t public` in the root directory of the project
6. Open `http://localhost:8000` in your browser

---

## Features

### 1. List All Events
**User Story**  
_As a User, I want to see a list of all events._

**Acceptance Criteria**
- [x] I can see all events on a list screen.

---

### 2. Add Event to Calendar
**User Story**  
_As a User, I want to be able to add an event to my Calendars._

**Acceptance Criteria**
- [x] I can add a new event with the following fields:
    - Event Title
    - Description
    - Start Date
    - End Date
- [x] I can see my newly added event on the list screen.

---

### 3. View Event Details
**User Story**  
_As a User, I want to be able to see the details of an event._

**Acceptance Criteria**
- [ ] I can view the details of an event on a detail screen.
- [x] The detail screen is accessible via a "View details" link next to each event on the list screen.

---