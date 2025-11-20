import 'company.dart';
import 'screening.dart';

class Job {
  const Job({
    required this.id,
    required this.title,
    required this.description,
    required this.location,
    required this.type,
    required this.salary,
    required this.company,
    required this.publishedAt,
    this.screeningQuestions = const <ScreeningQuestion>[],
  });

  final int id;
  final String title;
  final String description;
  final String location;
  final String type;
  final String salary;
  final Company company;
  final DateTime publishedAt;
  final List<ScreeningQuestion> screeningQuestions;

  factory Job.fromJson(Map<String, dynamic> json) => Job(
        id: json['id'] as int,
        title: json['title'] as String,
        description: json['description'] as String,
        location: json['location'] as String? ?? 'Remote',
        type: json['type'] as String? ?? 'full_time',
        salary: json['salary'] as String? ?? '',
        company: Company.fromJson(json['company'] as Map<String, dynamic>),
        publishedAt: DateTime.parse(json['published_at'] as String),
        screeningQuestions: (json['screening_questions'] as List<dynamic>? ?? [])
            .map((e) => ScreeningQuestion.fromJson(e as Map<String, dynamic>))
            .toList(),
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'title': title,
        'description': description,
        'location': location,
        'type': type,
        'salary': salary,
        'company': company.toJson(),
        'published_at': publishedAt.toIso8601String(),
        'screening_questions':
            screeningQuestions.map((question) => question.toJson()).toList(),
      };
}
