using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using NetCore.Web.Models;

namespace NetCore.Web.Controllers
{
    public class MembershipController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }

        [HttpGet]
        public IActionResult Login()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken] // validate by using anti-forgery token. use this attribute for all POST requests
        public IActionResult Login(LoginInfo login)
        {
            string message = string.Empty;

            if (ModelState.IsValid)
            {
                // define a sample user credential to match
                string userID = "simonlee";
                string password = "19978707";

                if (login.UserID.Equals(userID) && login.Password.Equals(password))
                {
                    TempData["Message"] = "Login successful.";
                    return RedirectToAction("Index", "Membership"); // RedirectToAction(view, controller)
                }
            }
            else
            {
                message = "Invalid user credentials.";
            }

            ModelState.AddModelError(string.Empty, message);
            return View();
        }
    }
}
