const express = require("express");
const sequelize = require("./util/database");
const bodyParser = require("body-parser");
const path = require("path");

// const UserTypes = require('./models/user_type');
// const User = require('./models/user');
// const Departments = require('./models/departments');
// const Majors = require('./models/majors');
// const StudentsMajors = require('./models/student_majors');
// const Courses = require('./models/courses');
// const StudentsCourses = require('./models/students_courses');
// const Posts = require('./models/posts');
// const Comments = require('./models/comments');
// const StudentCVs = require('./models/studentsCVS');
// const StudentProjects = require('./models/students_projects');
// const StudentResearches = require('./models/student_researches');
// const Company = require("./models/company");
// const Jobs = require("./models/jobs");
// const StudentExperinces = require("./models/experience");

const app = express();
app.use(bodyParser.json());

sequelize
  .sync({ force: true })
  // .sync()
  .then((result) => {
    const server = app.listen(8080);
  })
  .catch((err) => {
    console.log("ERROR", err);
  });
