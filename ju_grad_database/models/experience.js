const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const StudentExperinces = sequelize.define(
  "student_experinces",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    company_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "companies",
        key: "id",
      },
    },
    job_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "jobs",
        key: "id",
      },
    },
    student_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "users",
        key: "id",
      },
    },
    description: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    start_date: {
      type: DataTypes.DATE,
      allowNull: false,
    },
    end_date: {
      type: DataTypes.DATE,
      allowNull: false,
    },
    created_at: {
      type: DataTypes.DATE,
      allowNull: false,
      defaultValue: Sequelize.literal("CURRENT_TIMESTAMP"),
    },
  },
  {
    timestamps: false,
  }
);

module.exports = StudentExperinces;
