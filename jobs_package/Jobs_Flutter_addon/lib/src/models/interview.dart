class InterviewSchedule {
  const InterviewSchedule({
    required this.id,
    required this.applicationId,
    required this.start,
    required this.end,
    this.location,
    this.link,
  });

  final int id;
  final int applicationId;
  final DateTime start;
  final DateTime end;
  final String? location;
  final String? link;

  factory InterviewSchedule.fromJson(Map<String, dynamic> json) =>
      InterviewSchedule(
        id: json['id'] as int,
        applicationId: json['application_id'] as int,
        start: DateTime.parse(json['start'] as String),
        end: DateTime.parse(json['end'] as String),
        location: json['location'] as String?,
        link: json['link'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'application_id': applicationId,
        'start': start.toIso8601String(),
        'end': end.toIso8601String(),
        'location': location,
        'link': link,
      };
}
